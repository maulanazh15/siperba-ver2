<!DOCTYPE html>
<html>
<head>
    <title>Laporan Barang Masuk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Laporan Barang Masuk</h1>

        <table class="table">
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
    </div>
</body>
</html>
