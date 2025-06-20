@extends('layouts.main')

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Hasil Perhitungan Profile Matching Karyawan</h2>

            <div class="mb-4 flex justify-start">
                <a href="{{ route('penilaian.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar Penilaian
                </a>
            </div>

            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">Peringkat</th>
                            <th scope="col" class="px-6 py-3">Nama Karyawan</th>
                            <th scope="col" class="px-6 py-3">Jabatan</th>
                            <th scope="col" class="px-6 py-3">Pekerjaan</th>
                            <th scope="col" class="px-6 py-3">Total Skor</th>
                            @foreach ($allKriterias as $kriteria)
                                <th scope="col" class="px-6 py-3 text-center">{{ $kriteria->kriteria }} (CF: {{ $kriteria->bobot_kriteria }}%)</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($results as $index => $result)
                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $index + 1 }}</td>
                                <td class="px-6 py-4">{{ $result['user']->name }}</td>
                                <td class="px-6 py-4">{{ $result['user']->jabatan->jabatan ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $result['user']->pekerjaan->pekerjaan ?? 'N/A' }}</td>
                                <td class="px-6 py-4 font-bold text-lg text-center">{{ number_format($result['total_score'], 2) }}</td>
                                @foreach ($allKriterias as $kriteria)
                                    <td class="px-6 py-4 text-center">
                                        {{ number_format($result['kriteria_scores'][$kriteria->kriteria] ?? 0, 2) }}
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ 5 + $allKriterias->count() }}" class="px-6 py-4 text-center text-gray-500">Belum ada hasil penilaian.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
