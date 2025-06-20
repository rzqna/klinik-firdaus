<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatans = Jabatan::all();
        return view('jabatan.index', compact('jabatans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jabatan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan' => 'required|string|max:255'
        ]);

        Jabatan::create([
            'jabatan' => $request->jabatan
        ]);

        return redirect()->route('jabatan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jabatan $jabatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jabatan $jabatan)
    {
        // Mengirim data jabatan yang akan diedit ($jabatan) ke view 'jabatan.edit'.
        return view('jabatan.edit', compact('jabatan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jabatan  $jabatan // Laravel akan otomatis mengisi ini
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jabatan $jabatan)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'jabatan' => 'required|string|max:255|unique:jabatans,jabatan,' . $jabatan->id, // Unik kecuali untuk dirinya sendiri
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Perbarui data jabatan dengan data yang sudah divalidasi
        $jabatan->update($validator->validated()); // Menggunakan validated() untuk mengambil data yang sudah divalidasi

        // Redirect kembali ke halaman daftar jabatan dengan pesan sukses
        return redirect()->route('jabatan.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jabatan $jabatan)
    {
        try {
            $jabatan->delete();
            return redirect()->route('jabatan.index');
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah saat menghapus (misal: ada relasi foreign key)
            return redirect()->back()->with('error', 'Gagal menghapus jabatan: ' . $e->getMessage());
        }
    }
}
