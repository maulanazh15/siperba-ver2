<?php

namespace App\Http\Controllers;

use App\Models\Klien;
use App\Models\Barang;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function __construct()
    {
        // Apply middleware to the controller actions
        $this->middleware('permission:view projects')->only('index', 'show');
        $this->middleware('permission:create projects')->only('create', 'store');
        $this->middleware('permission:edit projects')->only('edit', 'update');
        $this->middleware('permission:delete projects')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('view projects');
        $projects =  Project::all();
        return view('transaksi.project.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create projects');
        $klienList = Klien::all();
        $barangList = Barang::where('stok', '>', 0)->get();

        return view('transaksi.project.create', compact('klienList', 'barangList'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create projects');
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama_project' => 'required',
            'tanggal_pesan' => 'required',
            'barang_id' => 'required',
            'klien_id' => 'required',
            'harga_jual' => 'required',
            'jumlah_pesanan' => 'required',
            'status' => 'required',
            'detail' => 'required',
        ]);
        // dump($validatedData);
        // Buat instance dari model Project
        $project = new Project();

        // Isi properti-properti proyek dengan data yang diterima dari request
        $project->nama_project = $validatedData['nama_project'];
        $project->tanggal_pesan = $validatedData['tanggal_pesan'];
        $project->barang_id = $validatedData['barang_id'];
        $project->klien_id = $validatedData['klien_id'];
        $project->harga_jual = $validatedData['harga_jual'];
        $project->jumlah_pesanan = $validatedData['jumlah_pesanan'];
        $project->status = $validatedData['status'];
        $project->detail = $validatedData['detail'];

        // Simpan proyek ke basis data
        $project->save();

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        // ...

        // Contoh pengalihan ke halaman index proyek setelah disimpan
        return redirect()->route('project.index')->with('success', 'Proyek berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $this->authorize('edit projects');
        $project = Project::findOrFail($id);
        $klienList = Klien::all();
        $barangList = Barang::where('stok', '>', 0)->get();

        return view('transaksi.project.edit', compact('project', 'klienList', 'barangList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Only allow access if user has permission
        $this->authorize('edit projects');
        // Validasi data yang diterima dari request
        $validatedData = $request->validate([
            'nama_project' => 'required',
            'tanggal_pesan' => 'required',
            'barang_id' => 'required',
            'klien_id' => 'required',
            'harga_jual' => 'required',
            'jumlah_pesanan' => 'required',
            'status' => 'required',
            'detail' => 'required',
        ]);

        // Temukan project berdasarkan ID
        $project = Project::findOrFail($id);

        // Update properti-properit proyek dengan data yang diterima dari request
        $project->nama_project = $validatedData['nama_project'];
        $project->tanggal_pesan = $validatedData['tanggal_pesan'];
        $project->barang_id = $validatedData['barang_id'];
        $project->klien_id = $validatedData['klien_id'];
        $project->harga_jual = $validatedData['harga_jual'];
        $project->jumlah_pesanan = $validatedData['jumlah_pesanan'];
        $project->status = $validatedData['status'];
        $project->detail = $validatedData['detail'];

        // Simpan perubahan proyek ke basis data
        $project->save();

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        // ...

        // Contoh pengalihan ke halaman index proyek setelah diupdate
        return redirect()->route('project.index')->with('success', 'Proyek berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Only allow access if user has permission
        $this->authorize('delete projects');
        // Temukan project berdasarkan ID
        $project = Project::findOrFail($id);

        // Hapus project dari basis data
        $project->delete();

        // Redirect atau berikan respons sesuai kebutuhan aplikasi Anda
        // ...

        // Contoh pengalihan ke halaman index proyek setelah dihapus
        return redirect()->route('project.index')->with('success', 'Proyek berhasil dihapus');
    }

    public function ambilDataProject($project_id)
    {
        // Only allow access if user has permission
        $this->authorize('edit projects');
        $project = Project::where('id', $project_id)->first();

        $data = [
            'barang_id' => $project->barang_id,
            'nama_barang' => $project->barang->nama_barang,
            'stok_barang' => $project->barang->stok,
            'jumlah_keluar' => $project->jumlah_pesanan,
            'tanggal_pesan' => $project->tanggal_pesan,
        ];
        // dd($data);
        return response()->json($data);
    }
}
