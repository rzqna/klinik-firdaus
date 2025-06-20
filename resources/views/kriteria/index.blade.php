@extends('layouts.main')
@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Data Kriteria</h2>
            <div class="flex justify-end mb-4">
                <a href="{{ route('kriteria.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    + Tambah Data
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Kriteria</th>
                            <th scope="col" class="px-6 py-3 text-center">Core Factor (%)</th>
                            <th scope="col" class="px-6 py-3 text-center">Secondary Factor (%)</th>
                            <th scope="col" class="px-6 py-3">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kriterias as $kriteria)
                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $kriteria->kriteria }}</td>
                                <td class="px-6 py-4 text-center">{{ $kriteria->bobot_kriteria }}%</td>
                                <td class="px-6 py-4 text-center">{{ 100 - $kriteria->bobot_kriteria }}%</td>
                                <td class="px-6 py-4 whitespace-pre-wrap">{{ $kriteria->keterangan }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{-- Tombol Edit (Icon Pensil Lebih Besar) --}}
                                    <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="inline-flex items-center p-2 text-yellow-600 hover:text-yellow-800 transition duration-150 ease-in-out" title="Edit">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus (Icon Tempat Sampah Lebih Besar) --}}
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kriteria ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:text-red-800 transition duration-150 ease-in-out" title="Hapus">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v1h6V5a1 1 0 011-1h4a1 1 0 011 1v1a1 1 0 01-1 1h-1a1 1 0 01-1-1z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">Belum ada data kriteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
