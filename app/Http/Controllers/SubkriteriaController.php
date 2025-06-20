<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; // Import Rule untuk validasi unique

class SubkriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subkriterias = SubKriteria::with('kriteria')->get();
        return view('subkriteria.index', compact('subkriterias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriterias = Kriteria::all();
        return view('subkriteria.create', compact('kriterias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kriteria_id' => 'required|exists:kriterias,id',
            'subkriteria' => [
                'required',
                'string',
                'max:255',
                // Pastikan subkriteria unik hanya untuk kriteria_id yang sama
                Rule::unique('subkriterias')->where(function ($query) use ($request) {
                    return $query->where('kriteria_id', $request->kriteria_id);
                }),
            ],
            'nilai_ideal' => 'required|integer|min:1|max:5',
            'keterangan' => 'nullable|string|max:255',
            'factor_type' => 'required|in:core,secondary',
        ]);

        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $dataToStore = $request->except('factor_type');
        $dataToStore['is_core_factor'] = ($request->factor_type === 'core');

        SubKriteria::create($dataToStore);
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubKriteria $subkriteria)
    {
        // Method ini biasanya tidak diperlukan jika Anda tidak memiliki halaman detail per subkriteria.
        // Biarkan kosong atau hapus jika tidak digunakan.
        abort(404); // Atau redirect ke index
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Show the form for editing the specified resource.
     * Menggunakan Route Model Binding untuk otomatis menemukan SubKriteria berdasarkan ID.
     *
     * @param  \App\Models\SubKriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function edit(SubKriteria $subkriteria)
    {
        // Ambil semua data Kriteria untuk ditampilkan di dropdown 'Pilih Kriteria Induk'
        $kriterias = Kriteria::all();

        // Mengirim data sub kriteria yang akan diedit ($subKriteria)
        // dan daftar kriteria ($kriterias) ke view 'subkriteria.edit'.
        return view('subkriteria.edit', compact('subkriteria', 'kriterias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubKriteria  $subKriteria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubKriteria $subkriteria)
    {
        // Validasi input dari form
        $validator = Validator::make($request->all(), [
            'kriteria_id' => 'required|exists:kriterias,id',
            'subkriteria' => [
                'required',
                'string',
                'max:255',
                // Validasi unik: nama subkriteria harus unik dalam lingkup kriteria_id yang sama,
                // tapi abaikan subkriteria saat ini ($subKriteria->id)
                Rule::unique('subkriterias')->where(function ($query) use ($request) {
                    return $query->where('kriteria_id', $request->kriteria_id);
                })->ignore($subkriteria->id),
            ],
            'nilai_ideal' => 'required|integer|min:1|max:5',
            'keterangan' => 'nullable|string|max:255',
            'factor_type' => 'required|in:core,secondary',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $dataToUpdate = $request->except('factor_type');
        $dataToUpdate['is_core_factor'] = ($request->factor_type === 'core');

        $subkriteria->update($dataToUpdate);
        return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubKriteria $subkriteria)
    {
        try {
            $subkriteria->delete();
            return redirect()->route('subkriteria.index')->with('success', 'Subkriteria berhasil dihapus!');
        } catch (\Exception $e) {
            // Tangani error jika terjadi masalah saat menghapus (misal: ada relasi foreign key)
            return redirect()->back()->with('error', 'Gagal menghapus subkriteria: ' . $e->getMessage());
        }
    }
}
