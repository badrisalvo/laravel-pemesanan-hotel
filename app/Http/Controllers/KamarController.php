<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Kamar;
use App\Models\About;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KamarController extends Controller
{
    public function index()
    {
        $kamar = Kamar::with('kategori')->orderBy('room_number', 'asc')->paginate(10);
        $kategori = Kategori::all();
        return view('admin.kamar', compact('kamar', 'kategori'));
    }


    public function userIndex()
    {
        $kamar = Kamar::with('kategori')->where('status', 1)->paginate(10); 
        $kategori = Kategori::all();
        return view('user.room', compact('kamar', 'kategori'));
    }

    public function userHome()
    {
        $recentRooms = Kamar::orderBy('created_at', 'desc')->take(6)->get();
        $recentRoomsViews = Kamar::orderBy('created_at', 'desc')->where('status', 1)->take(6)->get();
        $kamar = Kamar::with('kategori')->where('status', 1)->get(); 
        $about = About::first();
        return view('home', compact('kamar', 'recentRooms','recentRoomsViews', 'about'));
    }
    
    public function show($id)
    {
        $kamar = Kamar::findOrFail($id);
        $kategori = Kategori::all();
        return view('user.roomdetail', compact('kamar','kategori'));
    }


    public function store(Request $request)
    {
        Log::info('Request data:', $request->all());

        $request->validate([
            'room_number' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'harga' => 'required|numeric',
            'status' => 'required|boolean',
            'kategori_id' => 'required|exists:kategori,id',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $fileName);
            $data['image'] = $fileName;
        }

        try {
            Kamar::create($data);
            Log::info('Data saved successfully');
        } catch (\Exception $e) {
            Log::error('Error saving data:', ['error' => $e->getMessage()]);
            return redirect()->route('kamar.index')->with('error', 'Error saving data: ' . $e->getMessage());
        }

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'room_number' => 'required|string|max:255',
            'kapasitas' => 'required|integer',
            'harga' => 'required|numeric',
            'status' => 'required|boolean',
            'kategori_id' => 'required|exists:kategori,id',
            'detail' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $kamar = Kamar::findOrFail($id);
        $data = $request->all();
        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($kamar->image && file_exists(public_path('images/' . $kamar->image))) {
                unlink(public_path('images/' . $kamar->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $kamar->update($data);

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kamar = Kamar::findOrFail($id);

        // Hapus gambar jika ada
        if ($kamar->image && file_exists(public_path('images/' . $kamar->image))) {
            unlink(public_path('images/' . $kamar->image));
        }

        $kamar->delete();

        return redirect()->route('kamar.index')->with('success', 'Kamar berhasil dihapus.');
    }
}
