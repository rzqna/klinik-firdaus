<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pekerjaans = Pekerjaan::all();
        return view('pekerjaan.index', compact('pekerjaans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pekerjaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:255'
        ]);

        Pekerjaan::create([
            'pekerjaan' => $request->pekerjaan
        ]);

        return redirect()->route('pekerjaan.index')->with('success', 'Data Pekerjaan Berhasil disimpan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pekerjaan $pekerjaan)
    {
        // Mengirim data pekerjaan yang akan diedit ($pekerjaan) ke view 'pekerjaan.edit'.
        return view('pekerjaan.edit', compact('pekerjaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'pekerjaan' => 'required|string|max:255|unique:pekerjaans,pekerjaan,' . $pekerjaan->id, // Unik kecuali untuk dirinya sendiri
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Perbarui data pekerjaan dengan data yang sudah divalidasi
        $pekerjaan->update($validator->validated()); // Menggunakan validated() untuk mengambil data yang sudah divalidasi

        // Redirect kembali ke halaman daftar pekerjaan dengan pesan sukses
        return redirect()->route('pekerjaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        try {
            $pekerjaan->delete();
            return redirect()->route('pekerjaan.index');
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah saat menghapus (misal: ada relasi foreign key)
            return redirect()->back()->with('error', 'Gagal menghapus pekerjaan: ' . $e->getMessage());
        }
    }
}
