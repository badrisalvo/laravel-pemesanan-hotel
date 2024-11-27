<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use Carbon\Carbon;
use PDF;

class LaporanController extends Controller
{
    public function index()
    {
        return view('admin.laporan');
    }

    public function downloadPDF(Request $request)
    {
        // Validasi input tanggal
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        // Ambil data booking dalam rentang tanggal yang dipilih
        $bookings = Booking::with(['user', 'kamar'])
            ->whereBetween('created_at', [$startDate, $endDate])
            ->where('status', 'completed')
            ->get();

        $date = Carbon::now()->format('d-m-Y');

        // Kirim data ke view untuk PDF
        $pdf = PDF::loadView('admin.laporan.laporan_pdf', compact('bookings', 'startDate', 'endDate', 'date'))
            ->setPaper('a4', 'landscape'); // Atur ukuran kertas dan orientasi

        // Unduh PDF
        return $pdf->download('laporan-booking-' . $date . '.pdf');
    }

    public function downloadUserPDF()
        {
            // Ambil semua data user
            $users = User::all();
            $date = Carbon::now()->format('d-m-Y');

            // Kirim data ke view untuk PDF
            $pdf = PDF::loadView('admin.laporan.user_pdf', compact('users', 'date'))
                ->setPaper('a4', 'portrait'); // Atur ukuran kertas dan orientasi

            // Unduh PDF
            return $pdf->download('laporan-user-' . $date . '.pdf');
        }

    public function downloadKeuanganPDF(Request $request)
        {
            // Validasi input tanggal
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
            ]);

            $startDate = Carbon::parse($request->input('start_date'));
            $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

            // Ambil data booking completed dalam rentang tanggal
            $bookings = Booking::with(['user', 'kamar'])
                ->whereBetween('created_at', [$startDate, $endDate])
                ->where('status', 'completed')
                ->get();

            // Hitung total pendapatan
            $totalPendapatan = $bookings->sum('harga');

            $date = Carbon::now()->format('d-m-Y');

            // Kirim data ke view untuk PDF
            $pdf = PDF::loadView('admin.laporan.keuangan_pdf', compact('bookings', 'startDate', 'endDate', 'totalPendapatan', 'date'))
                ->setPaper('a4', 'portrait');

            // Unduh PDF
            return $pdf->download('laporan-keuangan-' . $date . '.pdf');
        }

}
