<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="supplier"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Data Supplier" page="Data Master"></x-navbars.navs.auth>
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
                            <span class="alert-text">
                                <strong>Success!</strong> {{ session()->get('success') }}
                            </span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Tabel Supplier
                                </h6>
                            </div>
                        </div>
                        <div class="me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('supplier.create') }}">
                                <i class="material-icons text-sm">add</i>&nbsp;&nbsp;Tambah Supplier Baru
                            </a>
                        </div>
                        <div class="card-body px-0 pb-2">
                            <div class="table-responsive px-5 pb-3">
                                <table class="table align-items-center mb-0" id="tabelSupplier">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NO
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NAMA SUPPLIER
                                            </th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                ALAMAT
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                NO TELEPON
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                REKENING
                                            </th>
                                            <th class="text-secondary opacity-7"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($suppliers as $supplier)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <p class="mb-0 text-sm">{{ $loop->iteration }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $supplier->nama_supplier }}</h6>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $supplier->alamat }}</h6>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs text-secondary mb-0">{{ $supplier->no_telepon }}</p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span
                                                        class="text-secondary text-xs font-weight-bold">{{ $supplier->rekening }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a rel="tooltip" class="badge bg-gradient-success"
                                                        href="{{ route('supplier.edit', $supplier->id) }}">
                                                        <i class="material-icons">edit</i>
                                                        <div class="ripple-container"></div>
                                                    </a>
                                                    <a href="{{ route('supplier.destroy', $supplier->id) }}"
                                                        class="badge bg-gradient-danger"
                                                        onclick="event.preventDefault();
                                                                 if (confirm('Apakah Anda yakin ingin menghapus supplier ini?')) {
                                                                     document.getElementById('delete-form-{{ $supplier->id }}').submit();
                                                                 }">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                    <form id="delete-form-{{ $supplier->id }}" method="POST"
                                                        action="{{ route('supplier.destroy', $supplier->id) }}"
                                                        style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
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
    {{-- <x-plugins></x-plugins> --}}
    <script>
        $(document).ready(function() {
            $('#tabelSupplier').DataTable();
        });
    </script>
</x-layout>
