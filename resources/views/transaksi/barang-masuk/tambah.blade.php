<x-layout bodyClass="g-sidenav-show bg-gray-200">
    <x-navbars.sidebar activePage="barang-masuk"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <!-- Navbar -->
        <x-navbars.navs.auth titlePage="Barang Masuk" page="Transaksi Barang"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card my-4">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                <h6 class="text-white mx-3">
                                    Tambah Barang Masuk
                                </h6>
                            </div>
                        </div>
                        <div class="card-body px-0 pb-">
                            <div class="px-5 py-0">
                                <form method="POST" action="{{ route('barang-masuk.simpan') }}">
                                    @csrf
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('tanggal_masuk') }}">
                                            @error('tanggal_masuk')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Kode PO</label>
                                            <select class="form-control border border-2 p-2 pilihpo" name="kode_po"
                                                onchange="fillData(this.value)">
                                                <option value="" disabled selected>Pilih Kode PO</option>
                                                @foreach ($po as $item)
                                                    <option value="{{ $item->kode_po }}"
                                                        {{ old('kode_po') == $item->kode_po ? 'selected' : '' }}>
                                                        {{ $item->kode_po }} | {{ $item->barang->nama_barang }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('kode_po')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Nama Barang</label>
                                            <input type="text" name="nama_barang" id="nama_barang"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('nama_barang') }}" readonly>
                                            <input type="hidden" name="barang_id" id="barang_id">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Stok Barang</label>
                                            <input type="number" name="stok_barang" id="stok_barang"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('stok_barang') }}" readonly>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Jumlah Masuk</label>
                                            <input type="number" name="jumlah_masuk" id="jumlah_masuk"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('jumlah_masuk') }}" readonly>
                                            @error('jumlah_masuk')
                                                <p class="text-danger inputerror">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="form-label">Total Stok</label>
                                            <input type="number" name="total_stok" id="total_stok"
                                                class="form-control border border-2 p-2"
                                                value="{{ old('total_stok') }}" onchange="calculateTotalStock()"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <button type="submit" class="btn bg-gradient-dark">Submit</button>
                                            <a href="{{ route('barang-masuk.index') }}"
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
    <x-plugins></x-plugins>
</x-layout>

<script>
    function fillData(poId) {
        // Retrieve data based on selected PO ID
        fetchData(poId);

        function fetchData(poId) {
            var serverName = window.location.hostname;
            var protocol = window.location.protocol;
            var port = window.location.port;

            var baseUrl = protocol + "//" + serverName;
            if (port) {
                baseUrl += ":" + port;
            }
            fetch(baseUrl + '/ambilDataPO/' + poId)
                .then(response => response.json())
                .then(data => {
                    // Fill the form fields with the retrieved data
                    document.getElementById('nama_barang').value = data.nama_barang;
                    document.getElementById('jumlah_masuk').value = data.jumlah_masuk;
                    document.getElementById('stok_barang').value = data.stok_barang;
                    document.getElementById('barang_id').value = data.barang_id;

                    // Calculate total stock
                    calculateTotalStock();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }

        function calculateTotalStock() {
            var stok_barang = parseInt(document.getElementById('stok_barang').value);
            var jumlah_masuk = parseInt(document.getElementById('jumlah_masuk').value);
            var total_stok = isNaN(stok_barang) ? jumlah_masuk : stok_barang + jumlah_masuk;

            document.getElementById('total_stok').value = total_stok;
        }
    }
    $(document).ready(function() {
        $('.pilihpo').select2();
    });
</script>
