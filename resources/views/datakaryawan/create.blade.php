@extends('layouts.main')
@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Tambah Data Karyawan</h2>

            <form action="{{ route('user.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    {{-- Input Nama --}}
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Lengkap:</label>
                        <input type="text" id="name" name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror" value="{{ old('name') }}" placeholder="Masukkan nama lengkap">
                        @error('name')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Input Email --}}
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" id="email" name="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" value="{{ old('email') }}" placeholder="Masukkan alamat email">
                        @error('email')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Input NIK --}}
                    <div class="mb-4">
                        <label for="nik" class="block text-gray-700 text-sm font-bold mb-2">NIK:</label>
                        <input type="text" id="nik" name="nik" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('nik') border-red-500 @enderror" value="{{ old('nik') }}" placeholder="Masukkan NIK (16 digit)">
                        @error('nik')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Input Tanggal Lahir --}}
                    <div class="mb-4">
                        <label for="tgl_lahir" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Lahir:</label>
                        <input type="date" id="tgl_lahir" name="tgl_lahir" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('tgl_lahir') border-red-500 @enderror" value="{{ old('tgl_lahir') }}">
                        @error('tgl_lahir')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Dropdown untuk Memilih Jabatan --}}
                    <div class="mb-4">
                        <label for="jabatan_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Jabatan:</label>
                        <select id="jabatan_id" name="jabatan_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('jabatan_id') border-red-500 @enderror">
                            <option value="">-- Pilih Jabatan (Opsional) --</option>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id }}" {{ old('jabatan_id') == $jabatan->id ? 'selected' : '' }}>
                                    {{ $jabatan->jabatan }}
                                </option>
                            @endforeach
                        </select>
                        @error('jabatan_id')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Dropdown untuk Memilih Pekerjaan --}}
                    <div class="mb-4">
                        <label for="pekerjaan_id" class="block text-gray-700 text-sm font-bold mb-2">Pilih Pekerjaan:</label>
                        <select id="pekerjaan_id" name="pekerjaan_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('pekerjaan_id') border-red-500 @enderror">
                            <option value="">-- Pilih Pekerjaan (Opsional) --</option>
                            @foreach ($pekerjaans as $pekerjaan)
                                <option value="{{ $pekerjaan->id }}" {{ old('pekerjaan_id') == $pekerjaan->id ? 'selected' : '' }}>
                                    {{ $pekerjaan->pekerjaan }}
                                </option>
                            @endforeach
                        </select>
                        @error('pekerjaan_id')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Input Role --}}
                    <div class="mb-4">
                        <label for="role" class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                        <select id="role" name="role" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('role') border-red-500 @enderror">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    {{-- Input Password --}}
                    <div class="mb-6">
                        <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password:</label>
                        <input type="password" id="password" name="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline @error('password') border-red-500 @enderror" placeholder="Masukkan password">
                        @error('password')<p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-200">
                        <a href="{{ route('datakaryawan.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-150 ease-in-out">
                            Simpan Karyawan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
