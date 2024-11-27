<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Menampilkan semua data pengguna
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.pengunjung', compact('users'));
    }

    // Menyimpan data pengguna baru
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string',
            'phone_number' => 'required|string|max:15',
        ]);
    
        // Membuat pengguna baru
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
        ]);
    
        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('admin.pengunjung')->with('success', 'User berhasil ditambahkan');
    }
    
    // Memperbarui data pengguna
    public function updatez(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|string',
            'phone_number' => 'required|string|max:15',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'phone_number' => $request->phone_number,
        ]);

        return redirect()->route('admin.pengunjung')->with('success', 'User berhasil diperbarui');
    }
    
    
    // Menghapus data pengguna
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.pengunjung')->with('success', 'User berhasil dihapus');
    }

    public function edit()
    {
        $user = Auth::user(); // Mendapatkan data pengguna yang sedang login
        return view('user.profile', compact('user')); // Mengirim data ke view
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . Auth::id(),
            'phone_number' => 'required|string|max:15',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;

        // Update password jika ada
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user.profile')->with('success', 'Profile updated successfully.');
    }
}
