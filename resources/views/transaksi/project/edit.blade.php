<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="project"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Edit Data Project" page="Data Master"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Edit Data Project
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method="POST" action="{{ route('project.update', $project->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label class="form-label">Nama Project</label>
                                        <input type="text" name="nama_project"
                                            class="form-control border border-2 p-2" value="{{ $project->nama_project }}">
                                        @error('nama_project')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Pesanan</label>
                                        <input type="date" name="tanggal_pesan"
                                            class="form-control border border-2 p-2" value="{{ $project->tanggal_pesan }}">
                                        @error('tanggal_pesan')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Barang</label>
                                        <select class="form-control border border-2 p-2 pilihBarang" name="barang_id">
                                            <option value="" disabled selected>Pilih Barang</option>
                                            @foreach ($barangList as $barang)
                                                <option value="{{ $barang->id }}" {{ (old('barang_id', $project->barang_id) == $barang->id) ? 'selected' : '' }}>
                                                    {{ $barang->nama_barang }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('barang_id')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Klien</label>
                                        <select class="form-control border border-2 p-2 pilihKlien" name="klien_id">
                                            <option value="" disabled selected>Pilih Klien</option>
                                            @foreach ($klienList as $klien)
                                                <option value="{{ $klien->id }}" {{ (old('klien_id', $project->klien_id) == $klien->id) ? 'selected' : '' }}>
                                                    {{ $klien->nama_klien }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('klien_id')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>     
                                    <div class="mb-3">
                                        <label class="form-label">Harga Jual Barang</label>
                                        <input type="number" name="harga_jual"
                                            class="form-control border border-2 p-2"
                                            value="{{ $project->harga_jual }}">
                                        @error('harga_jual')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Pesanan Barang</label>
                                        <input type="number" name="jumlah_pesanan"
                                            class="form-control border border-2 p-2"
                                            value="{{ $project->jumlah_pesanan }}">
                                        @error('jumlah_pesanan')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control border border-2 p-2" name="status">
                                            <option value="" disabled selected>Pilih Status</option>
                                            <option value="Pending" {{ $project->status == 'Pending' ? 'selected' : '' }}>
                                                Pending</option>
                                            <option value="Dalam Proses"
                                                {{ $project->status == 'Dalam Proses' ? 'selected' : '' }}>Dalam Proses
                                            </option>
                                            <option value="Selesai" {{ $project->status == 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                        </select>
                                        @error('status')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Detail</label>
                                        <textarea class="form-control border border-2 p-2"
                                            name="detail">{{ $project->detail }}</textarea>
                                        @error('detail')
                                            <p class="text-danger inputerror">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn bg-gradient-dark">Submit</button>
                                        <a href="{{ route('project.index') }}" class="btn bg-gradient-info">Kembali</a>
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
    <script>
        $(document).ready(function() {
            $('.pilihKlien').select2();
        });
        $(document).ready(function() {
            $('.pilihBarang').select2();
        });
    </script>
    {{-- <x-plugins></x-plugins> --}}
</x-layout>
