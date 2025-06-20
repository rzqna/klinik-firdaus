<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\SubKriteria;
use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Jabatan;
use App\Models\Pekerjaan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Mungkin tidak terpakai jika relasi sudah cukup

class AdminController extends Controller
{
    function index(){
        return redirect()->route('dashboard.admin');
    }

    function admin(){
        // 1. Statistik Ringkas di Bagian Atas Dashboard
        $totalKaryawan = User::where('role', 'user')->count();

        // Jumlah Karyawan yang Sudah Dinilai
        // Mengambil user_id yang unik dari tabel 'penilaians'
        $karyawanSudahDinilai = Penilaian::distinct('user_id')->count();

        // Jumlah Core Factor dan Secondary Factor dari SubKriteria
        $totalCoreFactor = SubKriteria::where('is_core_factor', true)->count();
        $totalSecondaryFactor = SubKriteria::where('is_core_factor', false)->count();


        // 2. Data Perangkingan Karyawan (Bagian Bawah Dashboard)
        $allKaryawan = User::where('role', 'user')
                            ->with(['jabatan', 'pekerjaan']) // Load relasi jabatan dan pekerjaan
                            ->get();

        $rankedKaryawan = [];

        // Logika Perhitungan Skor (Ini adalah CONTOH, sesuaikan dengan metode perangkinganmu)
        // Saya asumsikan metode Profile Matching sederhana dengan gap dan pembobotan.
        // Gap mapping:
        // Selisih | Nilai Bobot
        // --------|------------
        // 0       | 5
        // 1       | 4.5
        // -1      | 4
        // 2       | 3.5
        // -2      | 3
        // 3+ / -3-| 2.5 (atau nilai lain)
        // Default | 1 (untuk selisih yang sangat jauh)

        foreach ($allKaryawan as $karyawan) {
            // Ambil semua penilaian untuk karyawan ini, berserta data SubKriteria terkait
            $penilaiansKaryawan = Penilaian::where('user_id', $karyawan->id)
                                         ->with('subKriteria')
                                         ->get();

            $totalNilaiBobotCore = 0;
            $countCoreFactorDinilai = 0;
            $totalNilaiBobotSecondary = 0;
            $countSecondaryFactorDinilai = 0;

            if ($penilaiansKaryawan->isEmpty()) {
                // Jika karyawan belum memiliki penilaian, skornya 0
                $finalScore = 0;
            } else {
                foreach ($penilaiansKaryawan as $penilaian) {
                    $nilaiKaryawan = $penilaian->nilai_karyawan;
                    $nilaiIdeal = $penilaian->subKriteria->nilai_ideal;
                    $isCoreFactor = $penilaian->subKriteria->is_core_factor;

                    $gap = $nilaiKaryawan - $nilaiIdeal;

                    // Konversi Gap ke Nilai Bobot (Sesuaikan tabel gap ini dengan punyamu!)
                    $nilaiBobotGap = match ($gap) {
                        0 => 5,
                        1 => 4.5,
                        -1 => 4,
                        2 => 3.5,
                        -2 => 3,
                        3 => 2.5, // Tambahan untuk gap 3
                        -3 => 2.5, // Tambahan untuk gap -3
                        default => 1, // Untuk selisih lainnya (lebih dari 3 atau kurang dari -3)
                    };

                    if ($isCoreFactor) {
                        $totalNilaiBobotCore += $nilaiBobotGap;
                        $countCoreFactorDinilai++;
                    } else {
                        $totalNilaiBobotSecondary += $nilaiBobotGap;
                        $countSecondaryFactorDinilai++;
                    }
                }

                // Hitung nilai rata-rata per faktor
                $nilaiRataRataCore = $countCoreFactorDinilai > 0 ? $totalNilaiBobotCore / $countCoreFactorDinilai : 0;
                $nilaiRataRataSecondary = $countSecondaryFactorDinilai > 0 ? $totalNilaiBobotSecondary / $countSecondaryFactorDinilai : 0;

                // Dapatkan bobot persentase dari Kriteria
                // Asumsi Kriteria memiliki bobot yang akan digunakan untuk menggabungkan Core dan Secondary Factor
                // Ini jika bobot core dan secondary factor didefinisikan secara global di Kriteria
                // Contoh: Kriteria "Disiplin" (Core) bobot 0.6, "Komunikasi" (Secondary) bobot 0.4
                // Kamu harus mendapatkan bobot ini sesuai dengan metodologimu.
                // Jika bobot 60% Core dan 40% Secondary adalah tetap, bisa langsung pakai 0.6 dan 0.4.
                // Jika bobot diambil dari tabel kriteria, maka harus diagregasi dari sana.

                // Contoh sederhana pembobotan tetap (misal 60% Core, 40% Secondary)
                $finalScore = ($nilaiRataRataCore * 0.6) + ($nilaiRataRataSecondary * 0.4);

                // Jika kamu memiliki bobot kriteria di tabel Kriterias yang perlu diagregasi:
                // $totalBobotCoreKriteria = Kriteria::whereHas('subkriterias', function($q) {
                //     $q->where('is_core_factor', true);
                // })->sum('bobot_kriteria');
                // $totalBobotSecondaryKriteria = Kriteria::whereHas('subkriterias', function($q) {
                //     $q->where('is_core_factor', false);
                // })->sum('bobot_kriteria');
                // $totalOverallBobot = $totalBobotCoreKriteria + $totalBobotSecondaryKriteria;

                // $presentaseCore = $totalOverallBobot > 0 ? $totalBobotCoreKriteria / $totalOverallBobot : 0;
                // $presentaseSecondary = $totalOverallBobot > 0 ? $totalBobotSecondaryKriteria / $totalOverallBobot : 0;
                // $finalScore = ($nilaiRataRataCore * $presentaseCore) + ($nilaiRataRataSecondary * $presentaseSecondary);
            }


            $rankedKaryawan[] = [
                'nama' => $karyawan->name,
                'jabatan' => $karyawan->jabatan->jabatan ?? 'N/A', // Pastikan relasi 'jabatan' di model User ada
                'pekerjaan' => $karyawan->pekerjaan->pekerjaan ?? 'N/A', // Pastikan relasi 'pekerjaan' di model User ada
                'skor' => round($finalScore, 2), // Bulatkan skor untuk tampilan
                'id' => $karyawan->id, // ID karyawan, berguna untuk detail jika ada
            ];
        }

        // Urutkan karyawan berdasarkan skor dari yang tertinggi ke terendah
        usort($rankedKaryawan, function($a, $b) {
            return $b['skor'] <=> $a['skor']; // Descending order
        });

        // Berikan peringkat
        $rank = 1;
        $prevScore = null;
        foreach ($rankedKaryawan as $key => $karyawan) {
            // Jika skor saat ini sama dengan skor sebelumnya, gunakan ranking yang sama
            if ($prevScore !== null && $karyawan['skor'] == $prevScore) {
                $rankedKaryawan[$key]['rangking'] = $rankedKaryawan[$key-1]['rangking'];
            } else {
                $rankedKaryawan[$key]['rangking'] = $rank;
            }
            $prevScore = $karyawan['skor'];
            $rank++; // Selalu tingkatkan rank untuk iterasi berikutnya, bahkan jika skor sama
                      // Ini akan memberikan peringkat unik meskipun skornya sama.
                      // Jika ingin peringkat sama untuk skor sama:
                      // if ($prevScore === null || $karyawan['skor'] != $prevScore) {
                      //     $rankedKaryawan[$key]['rangking'] = $rank;
                      // } else {
                      //     $rankedKaryawan[$key]['rangking'] = $rankedKaryawan[$key-1]['rangking'];
                      // }
                      // $prevScore = $karyawan['skor'];
                      // $rank++;
        }


        return view('admin', compact(
            'totalKaryawan',
            'karyawanSudahDinilai',
            'totalCoreFactor',
            'totalSecondaryFactor',
            'rankedKaryawan'
        ));
    }

    function user(){
        $user = Auth::user(); // Ambil data user yang sedang login

        // Ambil semua penilaian untuk user yang sedang login,
        // dengan eager loading relasi subKriteria dan kriteria induknya.
        $penilaians = Penilaian::where('user_id', $user->id)
                                ->with(['subKriteria.kriteria']) // Load subKriteria dan kriteria induknya
                                ->get();

        // Kirim data user dan penilaians ke view
        return view('user.index', compact('user', 'penilaians'));
    }

}
