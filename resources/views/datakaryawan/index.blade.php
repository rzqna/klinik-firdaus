@extends('layouts.main')

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Data Karyawan</h2>

            {{-- Container ini yang mengatur posisi pencarian (kiri) dan tombol (kanan) --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-4 gap-4">
                {{-- Bagian Kiri: Form Pencarian --}}
                <form action="{{ route('datakaryawan.index') }}" method="GET" class="w-full md:flex-grow md:max-w-md">
                    <div class="relative">
                        <input
                            type="text"
                            name="search"
                            placeholder="Cari nama atau email karyawan..."
                            class="pl-10 pr-4 py-2 w-full border rounded-lg focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out text-gray-900"
                            value="{{ request('search') }}"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </form>

                {{-- Bagian Kanan: Tombol Tambah Data --}}
                <a href="{{ route('user.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300 ease-in-out text-center w-full md:w-auto md:shrink-0">
                    + Tambah Data Karyawan
                </a>
            </div>

            {{-- Notifikasi (Success/Error) seharusnya sudah di layouts.main.blade.php. Hapus dari sini jika duplikat. --}}
            {{-- @if (session('success')) ... @endif --}}
            {{-- @if (session('error')) ... @endif --}}

            <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                <table class="w-full text-sm text-left text-gray-700">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama</th>
                            <th scope="col" class="px-6 py-3">Email</th>
                            <th scope="col" class="px-6 py-3">NIK</th>
                            <th scope="col" class="px-6 py-3">Tanggal Lahir</th>
                            <th scope="col" class="px-6 py-3">Jabatan</th>
                            <th scope="col" class="px-6 py-3">Pekerjaan</th>
                            <th scope="col" class="px-6 py-3">Role</th>
                            <th scope="col" class="px-6 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="bg-white border-b border-gray-100 hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->nik }}</td>
                                <td class="px-6 py-4">{{ $user->tgl_lahir ? $user->tgl_lahir->format('d-m-Y') : '-' }}</td>
                                <td class="px-6 py-4">
                                    {{ $user->jabatan ? $user->jabatan->jabatan : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user->pekerjaan ? $user->pekerjaan->pekerjaan : 'N/A' }}
                                </td>
                                <td class="px-6 py-4">{{ $user->role }}</td>
                                <td class="px-6 py-4 text-center whitespace-nowrap">
                                    {{-- Tombol Edit (Icon Pensil dengan background hover) --}}
                                    <a href="{{ route('user.edit', $user->id) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full text-yellow-600 hover:bg-yellow-100 hover:text-yellow-800 transition duration-150 ease-in-out" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                        </svg>
                                    </a>

                                    {{-- Tombol Hapus (Icon Tempat Sampah dengan background hover) --}}
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" class="inline-block ml-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center justify-center w-8 h-8 rounded-full text-red-600 hover:bg-red-100 hover:text-red-800 transition duration-150 ease-in-out" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h4a1 1 0 011 1v1h6V5a1 1 0 011-1h4a1 1 0 011 1v1a1 1 0 01-1 1h-1a1 1 0 01-1-1z"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-6 py-4 text-center text-gray-500">Belum ada karyawan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
