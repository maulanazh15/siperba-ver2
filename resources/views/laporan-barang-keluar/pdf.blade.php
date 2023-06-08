<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Keluar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>Laporan Barang Keluar</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanbarangKeluar as $barang)
                <tr>
                    <td>{{ $barang->barang->nama_barang }}</td>
                    <td>{{ $barang->jumlah_keluar }}</td>
                    <td>{{ $barang->tanggal_keluar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>