<!DOCTYPE html>
<html>
<head>
    <title>Laporan Stok Masuk</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-4 mb-4">Laporan Stok Masuk</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Kelompok</th>
                    <th>Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->stok }}</td>
                        <td>{{ $barang->kelompokBarang->nama_kelompok}}</td>
                        <td>{{ $barang->lokasiBarang->nama_lokasi}}</td>
                        {{-- <td>{{ $barang->created_at }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
