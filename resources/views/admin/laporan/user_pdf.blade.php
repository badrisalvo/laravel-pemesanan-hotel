<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data User</title>
    <style>
        /* Tambahkan CSS sesuai kebutuhan */
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
            font-size: 12px; /* Ukuran font untuk seluruh tabel */
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        /* Mengubah warna background header tabel menjadi biru laut */
        th {
            background-color: #1e3a8a;  /* Warna biru laut */
            color: white;  /* Menyesuaikan warna teks agar kontras */
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
            left: 25%;
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
            z-index: 10000;
        }

        /* Tanda tangan dan tanggal di kanan bawah */
        .ttd {
            position: absolute;
            bottom: 50px;
            right: 155px;
            text-align: center;
            font-size: 14px;
        }

        .ttd p:last-child {
            margin-top: 85px; /* Menambahkan jarak antara tanggal dan nama pemilik */
            text-align: center;
        }

        /* Mengatur halaman dalam orientasi potret */
        @page {
            size: A4 portrait;
            margin: 3mm;
        }

    </style>
</head>
<body>
    <!-- Logo di atas H1 -->
    <img src="https://images2.imgbox.com/f3/74/iu1bEWcV_o.png" alt="Logo Hotel" class="logo">
    
    <h1><u>Persamaan Hotel & Resort</u></h1>
    <h2>Laporan Data User</h2>
    <p>Tanggal Cetak: {{ $date }}</p>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Nomor Telepon</th>
                <th>Tanggal Bergabung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone_number }}</td>
                <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
