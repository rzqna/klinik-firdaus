@extends('layouts.main')
@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Data Subkriteria</h2>
            <div class="flex justify-end mb-4">
                <a href="{{ route('subkriteria.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out">
                    + Tambah Data
                </a>
            </div>

            {{-- Menampilkan pesan sukses atau error dari session --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Sukses!</strong>
                    <span class="block sm:inline">{{ session('success') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.196l-2.651 2.652a1.2 1.2 0 1 1-1.697-1.697L8.303 9.5l-2.651-2.651a1.2 1.2 0 0 1 1.697-1.697L10 7.803l2.651-2.652a1.2 1.2 0 0 1 1.697 1.697L11.696 9.5l2.652 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">Error!</strong>
                    <span class="block sm:inline">{{ session('error') }}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                        <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.196l-2.651 2.652a1.2 1.2 0 1 1-1.697-1.697L8.303 9.5l-2.651-2.651a1.2 1.2 0 0 1 1.697-1.697L10 7.803l2.651-2.652a1.2 1.2 0 0 1 1.697 1.697L11.696 9.5l2.652 2.651a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
            @endif

            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Kriteria</th>
                            <th scope="col" class="px-6 py-3">Sub Kriteria</th>
                            <th scope="col" class="px-6 py-3">Nilai Ideal</th>
                            <th scope="col" class="px-6 py-3">Tipe Faktor</th>
                            <th scope="col" class="px-6 py-3">Keterangan</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th> {{-- Aksi di Pojok Kanan --}}
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($subkriterias as $sk)
                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                {{-- Memastikan relasi kriteria ada sebelum mengakses propertinya --}}
                                <td class="px-6 py-4">{{ $sk->kriteria->kriteria ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $sk->subkriteria }}</td>
                                <td class="px-6 py-4">{{ $sk->nilai_ideal }}</td>
                                <td class="px-6 py-4">
                                    @if ($sk->is_core_factor)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Core Factor</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Secondary Factor</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-pre-wrap">{{ $sk->keterangan }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{-- Tombol Edit --}}
                                    <a href="{{ route('subkriteria.edit', $sk->id) }}" class="inline-flex items-center p-2 text-yellow-600 hover:text-yellow-800 transition duration-150 ease-in-out" title="Edit">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus --}}
                                    <form action="{{ route('subkriteria.destroy', $sk->id) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus subkriteria ini?');">
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
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">Belum ada data subkriteria.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
