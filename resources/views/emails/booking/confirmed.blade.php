<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Dikonfirmasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .logo {
            max-width: 250px;
            margin-bottom: 10px;
        }
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        p {
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Logo -->
        <img src="https://images2.imgbox.com/c6/c2/IMwU74Pl_o.png" alt="Logo Persamaan Hotel" class="logo">

        <!-- Judul -->
        <h1>Pemesanan Dikonfirmasi</h1>

        <!-- Isi Email -->
        <p>Kepada Yth. <strong>{{ $booking->user->name }}</strong>,</p>
        <p>Pemesanan Anda telah dikonfirmasi. Silakan unduh dokumen terlampir untuk melihat detail pemesanan Anda.</p>
        
        <!-- Penutup -->
        <p>Terima kasih,<br><strong>Persamaan Hotel</strong></p>

        <!-- Footer -->
        <div class="footer">
            &copy; 2024 Persamaan Hotel. All rights reserved.
        </div>
    </div>
</body>
</html>
