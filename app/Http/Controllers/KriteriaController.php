<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriterias = Kriteria::all();
        return view('kriteria.index', compact('kriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kriteria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kriteria' => 'required|string|max:255',
            'bobot_kriteria' => 'required|integer|min:0|max:100', // Pastikan angka 0-100
            'keterangan' => 'nullable|string|max:255', // Keterangan bisa nullable
        ]);

        if($validator->fails()){
            // kalo masih ada yang kurang di validasinya, dia bakal balik lagi, pake yang diinputin, juga pake error
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $kriterias['kriteria'] = $request->kriteria;
        $kriterias['bobot_kriteria'] = $request->bobot_kriteria;
        $kriterias['keterangan'] = $request->keterangan;

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Kriteria $kriteria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kriteria $kriteria) // Menggunakan Route Model Binding
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kriteria $kriteria) // Menggunakan Route Model Binding
    {
        $validator = Validator::make($request->all(), [
            'kriteria' => 'required|string|max:255',
            'bobot_kriteria' => 'required|integer|min:0|max:100', // Pastikan angka 0-100
            'keterangan' => 'nullable|string|max:255', // Keterangan bisa nullable
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kriteria $kriteria) // Menggunakan Route Model Binding
    {
        $kriteria->delete();
        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus!');
    }
}
