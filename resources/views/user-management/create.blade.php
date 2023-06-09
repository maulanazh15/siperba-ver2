<x-layout bodyClass="g-sidenav-show  bg-gray-200">
    <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="User Management" page="Kelola User"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Tabel User
                                </h6>
                            </div>
                        </div>
                        {{-- <div class=" me-4 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                User</a>
                        </div> --}}
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method='POST' action='{{ route('user-management.store') }}'>
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" name="email"
                                                class="form-control border border-2 p-2" value="{{ old('email') }}">
                                            @error('email')
                                                <p class='text-danger inputerror'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama</label>
                                            <input type="text" name="name"
                                                class="form-control border border-2 p-2" value="{{ old('name') }}">
                                            @error('name')
                                                <p class='text-danger inputerror'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Role</label>
                                            <select class="form-control border border-2 p-2" name="akses">
                                                <option value="" disabled>Pilih Role</option>
                                                <option value="staff" {{ old('akses') == 'staff' ? 'selected' : '' }}>Staff Gudang</option>
                                                <option value="manajer" {{ old('akses') == 'manajer' ? 'selected' : '' }}>Manajer</option>
                                                <option value="pemilik" {{ old('akses') == 'pemilik' ? 'selected' : '' }}>Pemilik</option>
                                            </select>
                                            @error('akses')
                                                <p class='text-danger inputerror'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="form-control border border-2 p-2">
                                            @error('password')
                                                <p class='text-danger inputerror'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Konfirmasi Password</label>
                                            <input type="password" name="password_confirmation"
                                                class="form-control border border-2 p-2">
                                            @error('password_confirmation')
                                                <p class='text-danger inputerror'>{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" class="btn bg-gradient-dark">Submit</button>

                                            <a href="{{ route('user-management.index') }}"
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
    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.role').select2();
        });
    </script>
</x-layout>
