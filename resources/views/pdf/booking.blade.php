<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pemesanan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.6;
            text-align: left;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            font-size: 14px;
            color: #333;
        }
        td {
            font-size: 14px;
            color: #555;
        }
        .total-price {
            font-size: 18px;
            font-weight: bold;
            color: #28a745;
        }
        .footer {
            text-align: center;
            font-size: 14px;
            margin-top: 30px;
            color: #777;
            padding: 10px 0;
            border-top: 1px solid #ddd;
        }
        .footer a {
            color: #28a745;
            text-decoration: none;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 180px; /* Sesuaikan ukuran logo */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo -->
        <img src="https://images2.imgbox.com/c6/c2/IMwU74Pl_o.png" alt="Logo Hotel" class="logo">
        
        <h1>Booking Success</h1>
        
        <p>Terima kasih telah memilih Persamaan Hotel~
        <br>Pemesanan Anda telah dikonfirmasi.
        <br>Berikut adalah rincian pemesanan Anda:</p>
        
        <table>
            <tr>
                <th>ID Booking</th>
                <td><b>{{ $booking->id }}</b></td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $booking->user->name }}</td>
            </tr>
            <tr>
                <th>Tanggal Booking</th>
                <td>{{ \Carbon\Carbon::now()->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Nomor Kamar</th>
                <td>{{ $booking->kamar->room_number }}</td>
            </tr>
            <tr>
                <th>Tanggal Check-in</th>
                <td>{{ \Carbon\Carbon::parse($booking->check_in)->format('d F Y') }} 02.00 PM WIB</td>
            </tr>
            <tr>
                <th>Tanggal Check-out</th>
                <td>{{ \Carbon\Carbon::parse($booking->check_out)->format('d F Y') }} 11.50 AM WIB</td>
            </tr>
            <tr>
                <th>Total Harga</th>
                <td class="total-price">Rp {{ number_format($booking->harga, 0, ',', '.') }}</td>
            </tr>
        </table>
        <p>Harap perlihatkan dokumen ini pada saat Check-in</p>
        <p>Jika Anda memiliki pertanyaan atau membutuhkan bantuan lebih lanjut, jangan ragu untuk <a href="mailto:persamaan_hotel@gmail.com">menghubungi kami</a>.</p>
        <p> Terima Kasih, </p>

        <div class="footer">
            <p>&copy; 2024 Persamaan Hotel</p>
        </div>
    </div>
</body>
</html>
