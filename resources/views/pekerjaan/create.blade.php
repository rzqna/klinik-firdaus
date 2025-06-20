@extends('layouts.main')
@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <form action="{{ route('pekerjaan.store')}}" method="POST">
            @csrf
            <div class="bg-white p-8 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold mb-6 text-gray-800">Tambah Data Jabatan</h2>
                <div class="relative overflow-x-auto shadow-sm rounded-lg border border-gray-100">
                    <div class="space-y-6">
                        <div class="p-8 bg-white rounded-lg shadow-md flex-grow">
                        {{-- Input --}}
                        <div class="mb-6">
                            <label for="nama-pekerjaan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                            <input
                                type="text"
                                id="nama-pekerjaan"
                                name="pekerjaan"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 ease-in-out"
                                placeholder="Masukkan nama pekerjaan"
                            >
                            @error('pekerjaan')
                                <small>{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mt-8 pt-4 flex justify-end space-x-4"> {{-- Border atas untuk pemisah --}}
                            <button type="button" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                                Batal
                            </button>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-150 ease-in-out">
                                Simpan Data
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
