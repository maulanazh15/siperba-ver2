<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
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
    <h1>Laporan Barang Masuk</h1>

    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Masuk</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($laporanbarangMasuk as $barang)
                <tr>
                    <td>{{ $barang->barang->nama_barang }}</td>
                    <td>{{ $barang->jumlah_masuk }}</td>
                    <td>{{ $barang->tanggal_masuk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>