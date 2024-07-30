<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        // Hanya admin yang bisa mengakses metode ini
        if (!Auth::user() || Auth::user()->role != 'admin') {
            return redirect('/'); // Atau halaman yang sesuai
        }

        $bookings = Booking::with(['user', 'kamar'])
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan created_at terbaru
            ->get();
        $users = User::all();
        $kamar = Kamar::all();
        return view('admin.booking', compact('bookings', 'users', 'kamar'));
    }

    public function userBookings()
    {
        // Pastikan pengguna sudah terautentikasi
        if (!Auth::check()) {
            return redirect('login'); // Redirect ke halaman login jika tidak terautentikasi
        }

        $bookings = Auth::user()->bookings()->with('kamar')->get();

        return view('user.booking', compact('bookings'));
    }

    public function create($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);
        return view('user.payment', compact('kamar'));
    }

    public function createPayment($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);
        return view('user.payment', compact('kamar'));
    }

    public function storePayment(Request $request, $kamar_id)
    {
        $request->validate([
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kamar = Kamar::findOrFail($kamar_id);
        $days = $this->calculateDays($request->check_in, $request->check_out);
        $totalPrice = $days * $kamar->harga;

        $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        Booking::create([
            'user_id' => Auth::id(),
            'kamar_id' => $kamar_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'harga' => $totalPrice,
            'bukti_bayar' => $buktiBayarPath,
            'status' => 'pending',
        ]);

        return redirect()->route('home')->with('success', 'Booking berhasil ditambahkan. Silakan lakukan pembayaran.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kamar_id' => 'required|exists:kamars,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $kamar = Kamar::findOrFail($request->kamar_id);
        $days = $this->calculateDays($request->check_in, $request->check_out);
        $totalPrice = $days * $kamar->harga;

        $buktiBayarPath = $request->file('bukti_bayar') ? $request->file('bukti_bayar')->store('bukti_bayar', 'public') : null;

        Booking::create(array_merge($request->all(), [
            'harga' => $totalPrice,
            'bukti_bayar' => $buktiBayarPath,
            'status' => 'pending',
        ]));

        return redirect()->route('booking.index')->with('success', 'Booking berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kamar_id' => 'required|exists:kamars,id',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after:check_in',
            'bukti_bayar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $booking = Booking::findOrFail($id);
        $kamar = Kamar::findOrFail($request->kamar_id);
        $days = $this->calculateDays($request->check_in, $request->check_out);
        $totalPrice = $days * $kamar->harga;

        $buktiBayarPath = $request->file('bukti_bayar') ? $request->file('bukti_bayar')->store('bukti_bayar', 'public') : $booking->bukti_bayar;

        $booking->update(array_merge($request->all(), [
            'harga' => $totalPrice,
            'bukti_bayar' => $buktiBayarPath,
        ]));

        return redirect()->route('booking.index')->with('success', 'Booking berhasil diperbarui.');
    }

 // Pastikan Carbon diimport

    public function checkAvailability(Request $request)
    {
        // Ambil tanggal check-in dan check-out dari request
        $checkInDate = $request->input('checkin_date');
        $checkOutDate = $request->input('checkout_date');
    
        // Validasi format tanggal
        $checkInDate = Carbon::parse($checkInDate);
        $checkOutDate = Carbon::parse($checkOutDate);
    
        // Ambil semua kamar yang tidak memiliki booking dalam rentang tanggal yang dipilih
        $kamar = Kamar::whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
            $query->where(function ($query) use ($checkInDate, $checkOutDate) {
                $query->where('check_in', '<', $checkOutDate)
                      ->where('check_out', '>', $checkInDate);
            });
        })
        ->paginate(9); // Menggunakan paginate untuk mendapatkan objek paginasi
    
        // Tampilkan data kamar yang tersedia ke halaman view
        return view('user.room-list', compact('kamar', 'checkInDate', 'checkOutDate'));
    }
    

    private function calculateDays($check_in, $check_out)
    {
        $checkInDate = new \DateTime($check_in);
        $checkOutDate = new \DateTime($check_out);
        $interval = $checkInDate->diff($checkOutDate);

        return $interval->days;
    }

    public function confirm($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->update(['status' => 'completed']);

        return redirect()->route('booking.index')->with('success', 'Booking telah dikonfirmasi.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
    }
}
