<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="klien"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Klien" page="Data Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Edit Klien
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method="post" action="{{ route('klien.update', $klien->id) }}">
                                    @method('PUT')
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Klien</label>
                                            <input type="text" name="nama_klien"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('nama_klien', $klien->nama_klien) }}">
                                            @error('nama_klien')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Perusahaan</label>
                                            <input type="text" name="perusahaan"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('perusahaan', $klien->perusahaan) }}">
                                            @error('perusahaan')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Divisi</label>
                                            <input type="text" name="divisi"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('divisi', $klien->divisi) }}">
                                            @error('divisi')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nomor Telepon</label>
                                            <input type="text" name="no_telepon"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('no_telepon', $klien->no_telepon) }}">
                                            @error('no_telepon')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" name="alamat"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('alamat', $klien->alamat) }}">
                                            @error('alamat')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" class="btn bg-gradient-primary">Submit</button>
                                            <a href="{{ route('klien.index') }}"
                                                class="btn bg-gradient-info">Kembali</a>
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
    {{-- <x-plugins></x-plugins> --}}
</x-layout>
