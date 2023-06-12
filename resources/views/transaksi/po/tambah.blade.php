<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="po-barang"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="PO Barang" page="Transaksi Barang Masuk"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Tambah PO Barang
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method="POST" action="{{ route('po.simpan') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Barang</label>
                                            <select class="form-control border border-2 p-2 pilihbarang" name="barang_id">
                                                <option value="" disabled selected>Pilih Nama Barang</option>
                                                @foreach ($barang as $item)
                                                    <option value="{{ $item->id }}" {{ old('barang_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('barang_id')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Tanggal PO</label>
                                            <input type="date" name="tanggal" class="form-control border border-2 p-2" value="{{ old('tanggal') }}">
                                            @error('tanggal')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Supplier</label>
                                            <select class="form-control border border-2 p-2 pilihsupplier" name="supplier_id">
                                                <option value="" disabled selected>Pilih Nama Supplier</option>
                                                @foreach ($supplier as $item)
                                                    <option value="{{ $item->id }}" {{ old('supplier_id') == $item->id ? 'selected' : '' }}>
                                                        {{ $item->nama_supplier }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('supplier_id')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Harga Barang</label>
                                            <input type="number" name="harga_barang" class="form-control border border-2 p-2" value="{{ old('harga_barang') }}">
                                            @error('harga_barang')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Jumlah Barang</label>
                                            <input type="number" name="jumlah_barang" class="form-control border border-2 p-2" value="{{ old('jumlah_barang') }}">
                                            @error('jumlah_barang')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Detail</label>
                                            <textarea class="form-control border border-2 p-2" name="detail">{{ old('detail') }}</textarea>
                                            @error('detail')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                                            <a href="{{ route('po.index') }}" class="btn bg-gradient-info">Kembali</a>
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
            $('.pilihbarang').select2();
        });
        $(document).ready(function() {
            $('.pilihsupplier').select2();
        });
    </script>
</x-layout>
