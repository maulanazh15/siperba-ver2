<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Tambah Kelompok Barang
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method="POST" action="{{ route('kelompok-barang.update', $kelompokBarang->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Kelompok</label>
                                            <input type="text" name="nama_kelompok" class="form-control border border-2 p-2" value="{{ old('nama_kelompok', $kelompokBarang->nama_kelompok) }}">
                                            @error('nama_kelompok')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" class="btn bg-gradient-dark">Update</button>
                                            <a href="{{ route('kelompok-barang.index') }}" class="btn bg-gradient-info">Kembali</a>
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
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            // Your select2 initialization code here
        });
    </script>
</x-layout>
