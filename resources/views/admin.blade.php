@extends('layouts.main')

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Dashboard Admin</h1>

        {{-- Bagian Atas: Statistik Ringkas --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Card: Jumlah Karyawan --}}
            <div class="bg-blue-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-600">Total Karyawan</h3>
                    <p class="text-4xl font-bold text-blue-600">{{ $totalKaryawan }}</p>
                </div>
                <div class="text-blue-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h-5v-2a3 3 0 013-3h1a3 3 0 013 3v2zm-3-11a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
            </div>

            {{-- Card: Karyawan Sudah Dinilai --}}
            <div class="bg-green-100 p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-600">Karyawan Sudah Dinilai</h3>
                    <p class="text-4xl font-bold text-green-600">{{ $karyawanSudahDinilai }}</p>
                </div>
                <div class="text-green-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
            </div>

            {{-- Card: Core Factor --}}
            <div class="bg-purple-100  p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-600">Total Core Factor</h3>
                    <p class="text-4xl font-bold text-purple-600">{{ $totalCoreFactor }}</p>
                </div>
                <div class="text-purple-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
            </div>

            {{-- Card: Secondary Factor --}}
            <div class="bg-yellow-100  p-6 rounded-lg shadow-md flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-600">Total Secondary Factor</h3>
                    <p class="text-4xl font-bold text-yellow-600">{{ $totalSecondaryFactor }}</p>
                </div>
                <div class="text-yellow-500">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
            </div>
        </div>

        {{-- Bagian Bawah: Perangkingan Karyawan --}}
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Ranking Karyawan</h2>

            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Ranking</th>
                            <th scope="col" class="px-6 py-3">Nama Karyawan</th>
                            <th scope="col" class="px-6 py-3">Jabatan</th>
                            <th scope="col" class="px-6 py-3">Pekerjaan</th>
                            <th scope="col" class="px-6 py-3">Skor</th>
                            {{-- <th scope="col" class="px-6 py-3">Detail</th> Tambah jika ada halaman detail per karyawan --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rankedKaryawan as $karyawan)
                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-6 py-4 font-bold text-lg text-gray-900 whitespace-nowrap">
                                    {{ $karyawan['rangking'] }}
                                    @if($karyawan['rangking'] == 1) <span class="ml-1 text-yellow-500">&#9733;</span> @endif
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $karyawan['nama'] }}</td>
                                <td class="px-6 py-4">{{ $karyawan['jabatan'] }}</td>
                                <td class="px-6 py-4">{{ $karyawan['pekerjaan'] }}</td>
                                <td class="px-6 py-4 font-semibold">{{ $karyawan['skor'] }}</td>
                                {{-- <td class="px-6 py-4">
                                    <a href="{{ route('penilaian.detail', $karyawan['id']) }}" class="text-blue-600 hover:underline">Lihat Detail</a>
                                </td> --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-500">Belum ada data penilaian untuk perangkingan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
