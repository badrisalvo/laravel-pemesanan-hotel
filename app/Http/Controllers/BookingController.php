<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;
use App\Models\Kamar;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingConfirmed;
use PDF;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index()
    {
        if (!Auth::user() || Auth::user()->role != 'admin') {
            return redirect('/'); // Atau halaman yang sesuai
        }

        $bookings = Booking::with(['user', 'kamar'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        $users = User::all();
        $kamar = Kamar::all();
        return view('admin.booking', compact('bookings', 'users', 'kamar'));
    }

    public function userBookings()
    {
        if (!Auth::check()) {
            return redirect('login');
        }

        $bookings = Auth::user()->bookings()->with('kamar')
        ->orderBy('created_at', 'desc')
        ->get();

        return view('user.booking', compact('bookings'));
    }

    public function create($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);

        // Ambil semua booking untuk kamar tertentu
        $bookings = Booking::where('kamar_id', $kamar_id)
            ->where('status', '!=', 'completed') // Menyaring status booking
            ->get();

        // Menghitung tanggal yang tidak tersedia
        $unavailableDates = [];
        foreach ($bookings as $booking) {
            $start = Carbon::parse($booking->check_in);
            $end = Carbon::parse($booking->check_out);
            while ($start->lt($end)) {
                $unavailableDates[] = $start->format('Y-m-d');
                $start->addDay();
            }
        }

        return view('user.payment', compact('kamar', 'unavailableDates'));
    }

    public function showPayment($kamar_id)
    {
        $kamar = Kamar::find($kamar_id);
        $bookedDates = Booking::where('kamar_id', $kamar_id)
            ->where(function ($query) {
                $query->where('status', 'confirmed');
            })
            ->get(['check_in', 'check_out'])
            ->flatMap(function ($booking) {
                return $this->getDatesInRange($booking->check_in, $booking->check_out);
            })
            ->unique()
            ->toArray();
    
        return view('user.payment', [
            'kamar' => $kamar,
            'unavailableDates' => $bookedDates,
        ]);
    }
    
    private function getDatesInRange($startDate, $endDate)
    {
        $dates = [];
        $current = strtotime($startDate);
        $end = strtotime($endDate);
    
        while ($current <= $end) {
            $dates[] = date('Y-m-d', $current);
            $current = strtotime('+1 day', $current);
        }
    
        return $dates;
    }

    public function createPayment($kamar_id)
    {
        $kamar = Kamar::findOrFail($kamar_id);
    
        // Ambil tanggal yang sudah dipesan untuk kamar ini
        $bookings = Booking::where('kamar_id', $kamar_id)
            ->where(function ($query) {
                $query->where('check_out', '>', now());
            })
            ->get();
    
        $unavailableDates = [];
        foreach ($bookings as $booking) {
            $checkIn = Carbon::parse($booking->check_in);
            $checkOut = Carbon::parse($booking->check_out);
            while ($checkIn->lte($checkOut)) {
                $unavailableDates[] = $checkIn->toDateString();
                $checkIn->addDay();
            }
        }
    
        $unavailableDates = array_unique($unavailableDates);
    
        return view('user.payment', compact('kamar', 'unavailableDates'));
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

        // Generate ID Booking Unik
        do {
            $idBooking = random_int(1000000000, 9999999999); // Big integer dengan 10 digit
        } while (Booking::where('id', $idBooking)->exists());

        // Simpan bukti bayar
        $buktiBayarPath = $request->file('bukti_bayar')->store('bukti_bayar', 'public');

        // Simpan data booking
        $booking = Booking::create([
            'id' => $idBooking, // Masukkan ID random unik
            'user_id' => Auth::id(),
            'kamar_id' => $kamar_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'harga' => $totalPrice,
            'bukti_bayar' => $buktiBayarPath,
            'status' => 'pending',
        ]);

        // Kirim notifikasi email (jika diperlukan)
        // Mail::to(Auth::user()->email)->send(new BookingConfirmed($booking));

        return redirect()->route('user.bookings')->with('success', 'Booking berhasil ditambahkan.');
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
    
        // Generate ID Booking Unik
        do {
            $idBooking = random_int(1000000000, 9999999999); // Big integer dengan 10 digit
        } while (Booking::where('id', $idBooking)->exists());
    
        // Simpan bukti bayar (jika ada)
        $buktiBayarPath = $request->file('bukti_bayar') 
            ? $request->file('bukti_bayar')->store('bukti_bayar', 'public') 
            : null;
    
        // Simpan data booking
        Booking::create([
            'id' => $idBooking, // Masukkan ID random unik
            'user_id' => $request->user_id,
            'kamar_id' => $request->kamar_id,
            'check_in' => $request->check_in,
            'check_out' => $request->check_out,
            'harga' => $totalPrice,
            'bukti_bayar' => $buktiBayarPath,
            'status' => 'pending',
        ]);
    
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

    public function checkAvailability(Request $request)
    {
        $checkInDate = $request->input('checkin_date');
        $checkOutDate = $request->input('checkout_date');
    
        if (!$checkInDate || !$checkOutDate) {
            return view('user.room-list', [
                'kamar' => collect(), 
                'checkInDate' => null,
                'checkOutDate' => null,
            ]);
        }
    
        $checkInDate = Carbon::parse($checkInDate);
        $checkOutDate = Carbon::parse($checkOutDate);

        $kamar = Kamar::where('status', 1)
        ->whereDoesntHave('bookings', function ($query) use ($checkInDate, $checkOutDate) {
            $query->where('check_in', '<', $checkOutDate)
                  ->where('check_out', '>', $checkInDate);
        })
        ->paginate(9);
 
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
        Mail::to($booking->user->email)->send(new BookingConfirmed($booking));

        return redirect()->route('booking.index')->with('success', 'Booking telah dikonfirmasi.');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('booking.index')->with('success', 'Booking berhasil dihapus.');
    }

    public function downloadPdf($id)
    {
        // Ambil data booking berdasarkan ID
        $booking = Booking::findOrFail($id);

        // Generate PDF dari view
        $pdf = PDF::loadView('pdf.booking', compact('booking'));

        // Unduh file PDF
        return $pdf->download('booking-confirmation.pdf');
    }

}
