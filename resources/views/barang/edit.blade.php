<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="barang"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Barang" page="Data Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Edit Barang
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method="POST" action="{{ route('barang.update', $barang->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Barang</label>
                                            <input type="text" name="nama_barang" class="form-control border border-2 p-2" value="{{ $barang->nama_barang }}">
                                            @error('nama_barang')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Kelompok Barang</label>
                                            <select class="form-control border border-2 p-2 kelompok" name="kelompok_barang">
                                                <option value="" disabled selected>Pilih Kelompok Barang</option>
                                                @foreach ($kelompokBarang as $item)
                                                    <option value="{{ $item->id }}" {{ $barang->kelompok_barang_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_kelompok }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kelompok_barang')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Harga Beli</label>
                                            <input type="number" name="harga_beli" class="form-control border border-2 p-2" value="{{ $barang->harga_beli }}">
                                            @error('harga_beli')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Harga Jual</label>
                                            <input type="number" name="harga_jual" class="form-control border border-2 p-2" value="{{ $barang->harga_jual }}">
                                            @error('harga_jual')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Lokasi</label>
                                            <select class="form-control border border-2 p-2 lokasi" name="lokasi_barang">
                                                <option value="" disabled>Pilih Lokasi Barang</option>
                                                @foreach ($lokasiBarang as $item)
                                                    <option value="{{ $item->id }}" {{ $barang->lokasi_barang_id == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_lokasi }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('lokasi_barang')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Keterangan</label>
                                            <textarea class="form-control border border-2 p-2" name="keterangan">{{ $barang->keterangan }}</textarea>
                                            @error('keterangan')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                                            <a href="{{ route('barang.index') }}" class="btn bg-gradient-info">Kembali</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>
    <x-plugins></x-plugins>
    <script>
        $(document).ready(function() {
            $('.lokasi').select2();
        });
        $(document).ready(function() {
            $('.kelompok').select2();
        });
    </script>
</x-layout>
