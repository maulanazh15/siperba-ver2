<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
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
                    <td>{{ $barang->nama_barang }}</td>
                    <td>{{ $barang->jumlah }}</td>
                    <td>{{ $barang->tanggal_masuk }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ url('/laporan-barang-masuk/export-pdf') }}">Export PDF</a>
</body>
</html