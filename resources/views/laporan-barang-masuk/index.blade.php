<x-layout bodyClass="g-sidenav-show bg-gray-200">
<x-navbars.sidebar activePage="laporan-barang-masuk"></x-navbars.sidebar>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
    <!-- Navbar -->
    <x-navbars.navs.auth titlePage="Laporan Barang Masuk" page="Laporan Barang"></x-navbars.navs.auth>
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show mb-5 text-white" role="alert">
                    <span class="alert-icon align-middle">
                        <span class="material-icons text-md">
                            thumb_up_off_alt
                        </span>
                    </span>
                    <span class="alert-text"><strong>Success!</strong> {{ session()->get('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-info shadow-info border-radius-lg pt-4 pb-3">
                            <h6 class="text-white mx-3">
                                Laporan Barang Masuk
                            </h6>
                        </div>
                    </div>
                    <div class="me-3 my-3 text-end">
                        <a class="btn bg-gradient-dark mb-0" href="{{ url('/laporan-barang-masuk/export-pdf') }}"><i class="material-icons text-sm">picture_as_pdf</i>&nbsp;&nbsp;CETAK PDF</a>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive px-5 pb-3">
                            <table class="table align-items-center mb-0" id="tabelBarang">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NO
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            NAMA BARANG</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            JUMLAH</th>
                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            TANGGAL MASUK</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($laporanbarangMasuk as $barang)
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <p class="mb-0 text-sm">{{ $loop->iteration }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm">{{ $barang->barang->nama_barang }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs text-secondary mb-0">{{ $barang->jumlah_masuk }}</p>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <p class="text-xs text-secondary mb-0">{{$barang->created_at }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
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
        $('#tabelBarang').DataTable();
    });
</script>
</x-layout>