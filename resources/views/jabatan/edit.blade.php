@extends('layouts.main') {{-- Menggunakan layout utama kamu --}}

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Data Jabatan</h2>

            {{-- Form untuk mengedit jabatan --}}
            {{-- Action form ini akan mengarah ke method 'update' di JabatanController. --}}
            {{-- $jabatan->id akan digunakan untuk mengidentifikasi data yang akan diupdate. --}}
            <form action="{{ route('jabatan.update', $jabatan->id) }}" method="POST">
                @csrf {{-- Token CSRF untuk keamanan Laravel --}}
                @method('PUT') {{-- Menggunakan PUT method untuk update sesuai RESTful API --}}

                <div class="space-y-6">
                    {{-- Input Teks untuk Nama Jabatan --}}
                    <div class="mb-4">
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Nama Jabatan:</label>
                        <input
                            type="text"
                            id="jabatan"
                            name="jabatan"
                            class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('jabatan') border-red-500 @enderror"
                            value="{{ old('jabatan', $jabatan->jabatan) }}" {{-- Mengisi nilai awal dari database --}}
                            placeholder="Contoh: Manajer Operasional"
                            required
                        >
                        @error('jabatan')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tombol Batal dan Simpan Perubahan --}}
                    <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-200">
                        <a href="{{ route('jabatan.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-150 ease-in-out">
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
