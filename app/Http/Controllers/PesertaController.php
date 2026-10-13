<?php

namespace App\Http\Controllers;

use App\Models\Peserta;
use App\Models\Skema;
use Illuminate\Http\Request;

class PesertaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            // Admin melihat semua peserta
            $peserta = Peserta::with('skema')->latest()->get();
        } else {
            // User biasa HANYA melihat data miliknya berdasarkan pencocokan email
            $peserta = Peserta::with('skema')->where('email', $user->email)->get();
        }

        return view('peserta.index', compact('peserta'));
    }

    public function create()
    {
        $skema = Skema::all();
        return view('peserta.create', compact('skema'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nama'     => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email'    => 'required|email|unique:peserta,email',
            'no_hp'    => 'required|numeric|max:20',
            'skema_id' => 'required|exists:skema,id',
        ], [
            'nama.required'     => 'Nama peserta wajib diisi.',
            'nama.regex'        => 'Nama peserta hanya boleh berisi huruf dan spasi (tidak boleh mengandung angka atau simbol).',
            'email.required'    => 'Email wajib diisi.',
            'email.unique'      => 'Email ini sudah terdaftar.',
            'no_hp.numeric'     => 'Nomor HP harus berupa angka.',
            'no_hp.required'    => 'Nomor HP wajib diisi.',
            'no_hp.max'         => 'Nomor HP tidak boleh lebih dari 20 karakter.',
            'skema_id.required' => 'Pilih skema sertifikasi.',
        ]);

        // Masukkan data request sekaligus ikat dengan user_id yang sedang login
        $data = $request->all();
        $data['user_id'] = auth()->id();

        Peserta::create($data);

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil ditambahkan!');
    }

    public function show($id)
    {
        $peserta = Peserta::with('skema')->findOrFail($id);
        
        // Validasi hak akses lihat detail
        if (auth()->user()->role !== 'admin' && $peserta->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('peserta.show', compact('peserta'));
    }

    public function edit($id)
    {
        $peserta = Peserta::findOrFail($id);
        
        // Longgarkan validasi: Izinkan jika admin, ATAU user_id-nya sama, ATAU emailnya sama persis
        $isOwner = (auth()->id() && $peserta->user_id == auth()->id()) || (auth()->user()->email == $peserta->email);
        
        if (auth()->user()->role !== 'admin' && !$isOwner) {
            abort(403, 'Unauthorized action.');
        }

        $skema = Skema::all();
        return view('peserta.edit', compact('peserta', 'skema'));
    }

    public function update(Request $request, $id)
    {
        $peserta = Peserta::findOrFail($id);

        // Validasi kepemilikan data
        $isOwner = (auth()->id() && $peserta->user_id == auth()->id()) || (auth()->user()->email == $peserta->email);
        
        if (auth()->user()->role !== 'admin' && !$isOwner) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'nama'     => 'required|string|max:255|regex:/^[a-zA-Z\s]+$/',
            'email'    => 'required|email|unique:peserta,email,'.$id,
            'no_hp'    => 'required|string|max:20',
            'skema_id' => 'required|exists:skema,id',
        ], [
            'nama.regex' => 'Nama peserta hanya boleh berisi huruf dan spasi.',
            'no_hp.max'  => 'Nomor HP maksimal 20 karakter.',
        ]);

        // Update data sekaligus pastikan user_id terikat jika sebelumnya kosong
        $data = $request->all();
        if (empty($peserta->user_id)) {
            $data['user_id'] = auth()->id();
        }

        $peserta->update($data);

        // SETELAH SELESAI DI-EDIT, LANGSUNG DI-REDIRECT KEMBALI KE DASHBOARD
        if (auth()->user()->role == 'admin') {
            return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil diperbarui!');
        } else {
            return redirect()->route('dashboard')->with('success', 'Data diri berhasil diperbarui!');
        }
    }       

    public function destroy($id) 
    {
        $peserta = Peserta::findOrFail($id);
        $peserta->delete();

        return redirect()->route('peserta.index')->with('success', 'Data peserta berhasil dihapus!');
    }
}