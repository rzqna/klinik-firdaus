@extends('layouts.mainuser') {{-- Menggunakan layout utama kamu --}}

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Saya</h1>

        <div class="bg-white p-8 rounded-lg shadow-md mb-8">
            <h2 class="text-2xl font-bold mb-4 text-gray-800">Informasi Profil</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-lg text-gray-700">
                <div>
                    <span class="font-semibold">Nama:</span> {{ $user->name }}
                </div>
                <div>
                    <span class="font-semibold">Email:</span> {{ $user->email }}
                </div>
                <div>
                    <span class="font-semibold">Jabatan:</span> {{ $user->jabatan->jabatan ?? 'Belum ditentukan' }}
                </div>
                <div>
                    <span class="font-semibold">Pekerjaan:</span> {{ $user->pekerjaan->pekerjaan ?? 'Belum ditentukan' }}
                </div>
            </div>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Riwayat Penilaian Saya</h2>

            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Kriteria</th>
                            <th scope="col" class="px-6 py-3">Sub Kriteria</th>
                            <th scope="col" class="px-6 py-3">Nilai Ideal</th>
                            <th scope="col" class="px-6 py-3">Nilai Anda</th>
                            <th scope="col" class="px-6 py-3">Tipe Faktor</th>
                            <th scope="col" class="px-6 py-3">Keterangan</th>
                            <th scope="col" class="px-6 py-3">Tanggal Penilaian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($penilaians as $penilaian)
                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $penilaian->subKriteria->kriteria->kriteria ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $penilaian->subKriteria->subkriteria ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $penilaian->subKriteria->nilai_ideal ?? 'N/A' }}</td>
                                <td class="px-6 py-4 font-semibold text-blue-600">{{ $penilaian->nilai_karyawan }}</td>
                                <td class="px-6 py-4">
                                    @if ($penilaian->subKriteria->is_core_factor ?? false)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Core Factor</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Secondary Factor</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-pre-wrap">{{ $penilaian->subKriteria->keterangan ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($penilaian->tanggal_penilaian)->format('d F Y') }}</td> {{-- Format tanggal --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">Anda belum memiliki riwayat penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
