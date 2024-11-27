<!DOCTYPE html>
<html>
<head>
    <title>Laporan Keuangan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 12px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #1e3a8a;
            color: white;
        }

        h1, h2 {
            margin: 0;
            margin-top: 3px;
            text-align: center;
        }

        h1 {
            font-size: 18px;
            margin-top: 50px;
        }

        h2 {
            font-size: 15px;
            margin-right: 10px;
        }

        p {
            font-size: 14px;
            position: relative;
            left: 15%;
            transform: translateX(50%);
            margin-top: -13px;
            text-align: left;
        }

        .logo {
            position: absolute;
            top: -11px;
            left: 50%;
            transform: translateX(-50%);
            width: 160px;
        }

        .total {
            margin-top: 20px;
            font-size: 14px;
            text-align: right;
            margin-right: 30px;
        }

        .ttd {
            position: absolute;
            bottom: 50px;
            right: 155px;
            text-align: center;
            font-size: 14px;
        }

        .ttd p:last-child {
            margin-top: 85px;
        }

        @page {
            size: A4 portrait;
            margin: 3mm;
        }

    </style>
</head>
<body>
    <img src="https://images2.imgbox.com/f3/74/iu1bEWcV_o.png" alt="Logo Hotel" class="logo">
    
    <h1><u>Persamaan Hotel & Resort</u></h1>
    <h2>Laporan Keuangan</h2>
    <p>Periode: {{ $startDate->format('d-m-Y') }} s/d {{ $endDate->format('d-m-Y') }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Nomor Kamar</th>
                <th>Tanggal Booking</th>
                <th>Check-in</th>
                <th>Check-out</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $booking->user->name }}</td>
                <td>{{ $booking->kamar->room_number }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->created_at)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d-m-Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d-m-Y') }}</td>
                <td>Rp. {{ number_format($booking->harga, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="total">
        <p><strong>Total Pendapatan: Rp. {{ number_format($totalPendapatan, 0, ',', '.') }}</strong></p>
    </div>

    <div class="ttd">
        <p>Padang, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
        <p>Nama Pemilik</p>
    </div>
</body>
</html>
