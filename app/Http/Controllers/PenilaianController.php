<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Untuk transaksi database
use Illuminate\Support\Facades\Validator; // Untuk validasi

class PenilaianController extends Controller
{
    // Skala GAP (Selisih) -> Nilai Bobot (Ini adalah aturan perhitungan Profile Matching Anda)
    private $gapScale = [
        0 => 5.0,
        1 => 4.5,
        -1 => 4.0,
        2 => 3.5,
        -2 => 3.0,
        3 => 2.5,
        -3 => 2.0,
        4 => 1.5,
        -4 => 1.0,
    ];

    /**
     * Menampilkan daftar karyawan untuk dipilih dan dinilai.
     * Ini adalah halaman 'index' untuk modul penilaian.
     */
    public function index()
    {
        // Ambil semua user dengan role 'user', eager load jabatan, pekerjaan, dan penilaian yang sudah ada
        $users = User::where('role', 'user')->with('jabatan', 'pekerjaan', 'penilaian')->get();
        return view('penilaian.index', compact('users'));
    }

    /**
     * Menampilkan form penilaian untuk karyawan tertentu.
     * Form ini akan diisi dengan semua subkriteria dan nilai yang sudah ada (jika sedang edit).
     */
    public function create(User $user) // Menggunakan Route Model Binding
    {
        // Eager load relasi jabatan dan pekerjaan pada objek user untuk ditampilkan
        $user->load('jabatan', 'pekerjaan');

        // Ambil semua kriteria beserta subkriterianya untuk ditampilkan di form
        // Pastikan relasi 'subkriterias' ada di model Kriteria
        $kriterias = Kriteria::with('subkriterias')->get();

        // Ambil semua penilaian yang sudah ada untuk user ini, dalam bentuk array [subkriteria_id => nilai_karyawan]
        $existingPenilaian = Penilaian::where('user_id', $user->id)
                                            ->pluck('nilai_karyawan', 'subkriteria_id')
                                            ->toArray();

        return view('penilaian.create', compact('user', 'kriterias', 'existingPenilaian'));
    }

    /**
     * Menyimpan atau memperbarui penilaian karyawan yang diinput dari form.
     */
    public function store(Request $request, User $user) // Menggunakan Route Model Binding
    {
        $rules = [];
        // Validasi dinamis untuk setiap input nilai aktual subkriteria
        foreach ($request->input('nilai_aktual') as $subkriteriaId => $nilai) {
            // Pastikan nilai adalah integer, di antara 1 dan 5
            $rules['nilai_aktual.' . $subkriteriaId] = 'required|integer|min:1|max:5';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        // Memulai transaksi database untuk memastikan semua data tersimpan/diperbarui atau tidak sama sekali
        DB::beginTransaction();
        try {
            // Loop setiap subkriteria yang dinilai dari input form
            foreach ($request->input('nilai_aktual') as $subkriteriaId => $nilai) {
                // Update atau buat entri penilaian baru
                Penilaian::updateOrCreate(
                    ['user_id' => $user->id, 'subkriteria_id' => $subkriteriaId], // Kondisi untuk mencari/membuat
                    ['nilai_karyawan' => $nilai] // Data yang akan disimpan/diperbarui
                );
            }
            DB::commit(); // Komit transaksi jika semua berhasil

            // Redirect ke halaman hasil penilaian setelah berhasil menyimpan
            return redirect()->route('penilaian.index')->with('success', 'Penilaian karyawan berhasil disimpan dan hasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan penilaian: ' . $e->getMessage());
        }
    }

    /**
     * Menampilkan hasil perhitungan profile matching untuk semua karyawan.
     * Ini adalah halaman rekap skor akhir dan peringkat.
     */
    public function showResults()
    {
        $users = User::where('role', 'user')->get(); // Ambil semua user dengan role 'user'
        $allKriterias = Kriteria::with('subkriterias')->get(); // Ambil semua kriteria beserta subkriterianya
        $results = []; // Array untuk menyimpan hasil akhir setiap user

        foreach ($users as $user) {
            $sumOfKriteriaScores = 0; // Total skor kriteria untuk rata-rata
            $countedKriterias = 0;    // Jumlah kriteria yang memiliki skor
            $totalScore = 0;
            $kriteriaScores = []; // Skor detail per kriteria untuk user ini

            // Eager load penilaian user ini agar tidak N+1 query di loop subkriteria
            $user->load('penilaian');

            // Jika user belum memiliki penilaian, skor otomatis 0
            if ($user->penilaian->isEmpty()) {
                $results[] = [
                    'user' => $user,
                    'kriteria_scores' => [], // Tidak ada skor kriteria
                    'total_score' => 0, // Total skor 0
                    'status_penilaian' => 'Belum Dinilai',
                ];
                continue; // Lanjut ke user berikutnya
            }

            // Loop setiap kriteria untuk menghitung skornya
            foreach ($allKriterias as $kriteria) {
                $coreFactors = collect();    // Koleksi untuk bobot gap Core Factors
                $secondaryFactors = collect(); // Koleksi untuk bobot gap Secondary Factors

                // Loop setiap subkriteria di bawah kriteria saat ini
                foreach ($kriteria->subkriterias as $subkriteria) {
                    // Cari penilaian untuk subkriteria ini dari koleksi penilaian user
                    $penilaian = $user->penilaian->where('subkriteria_id', $subkriteria->id)->first();

                    if ($penilaian) { // Jika ada penilaian untuk subkriteria ini
                        $nilaiKaryawan = $penilaian->nilai_karyawan;
                        $nilaiIdeal = $subkriteria->nilai_ideal;
                        $gap = $nilaiKaryawan - $nilaiIdeal; // Hitung GAP

                        // Konversi GAP ke bobot nilai menggunakan $gapScale (mapping)
                        $bobotGap = $this->gapScale[$gap] ?? 0; // Default 0 jika gap tidak ada di skala

                        if ($subkriteria->is_core_factor) {
                            $coreFactors->push($bobotGap); // Masuk ke Core Factor
                        } else {
                            $secondaryFactors->push($bobotGap); // Masuk ke Secondary Factor
                        }
                    }
                }

                // Hitung rata-rata bobot gap untuk Core Factor dan Secondary Factor
                // Gunakan ?: 0 untuk menghindari error jika koleksi kosong
                $avgCoreFactor = $coreFactors->avg() ?: 0;
                $avgSecondaryFactor = $secondaryFactors->avg() ?: 0;

                // Hitung Skor Kriteria (gabungan CF dan SF)
                // Bobot_kriteria adalah persentase CF (misal 60%)
                $kriteriaScore = (($kriteria->bobot_kriteria / 100) * $avgCoreFactor) +
                                ((1 - ($kriteria->bobot_kriteria / 100)) * $avgSecondaryFactor);

                $kriteriaScores[$kriteria->kriteria] = $kriteriaScore; // Simpan skor kriteria ini
                // === PERUBAHAN DI SINI: Akumulasi untuk rata-rata ===
                if (!empty($kriteria->subkriterias) && ($avgCoreFactor > 0 || $avgSecondaryFactor > 0)) {
                    $sumOfKriteriaScores += $kriteriaScore;
                    $countedKriterias++;
                }
            }

            $finalTotalScore = ($countedKriterias > 0) ? ($sumOfKriteriaScores / $countedKriterias) : 0;
            // Tambahkan hasil user ini ke array results
            $results[] = [
                'user' => $user,
                'kriteria_scores' => $kriteriaScores,
                'total_score' => $finalTotalScore,
                'status_penilaian' => 'Sudah Dinilai', // Jika sampai sini berarti sudah dinilai
            ];
        }

        // Urutkan hasil berdasarkan total_score (nilai tertinggi di atas)
        $results = collect($results)->sortByDesc('total_score')->values()->all();

        return view('penilaian.result', compact('results', 'allKriterias'));
    }

        public function destroy(User $user) // Menggunakan Route Model Binding
    {
        DB::beginTransaction();
        try {
            // Hapus semua penilaian yang terkait dengan user ini
            Penilaian::where('user_id', $user->id)->delete();
            DB::commit();
            return redirect()->route('penilaian.index')->with('success', 'Semua penilaian untuk karyawan ' . $user->name . ' berhasil dihapus!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus penilaian: ' . $e->getMessage());
        }
    }
}
