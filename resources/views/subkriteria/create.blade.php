@extends('layouts.main')

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Tambah Data Sub Kriteria</h2>

            <form action="{{ route('subkriteria.store') }}" method="POST">
                @csrf

                <div class="space-y-6">
                    {{-- Dropdown untuk Memilih Kriteria --}}
                    <div class="mb-4">
                        <label for="kriteria_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Kriteria:</label>
                        <select
                            id="kriteria_id"
                            name="kriteria_id"
                            class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('kriteria_id') border-red-500 @enderror"
                            required
                        >
                            <option value="">-- Pilih Kriteria --</option>
                            @foreach ($kriterias as $kriteria)
                                <option value="{{ $kriteria->id }}" {{ old('kriteria_id') == $kriteria->id ? 'selected' : '' }}>
                                    {{ $kriteria->kriteria }}
                                </option>
                            @endforeach
                        </select>
                        @error('kriteria_id')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Teks untuk Nama Subkriteria --}}
                    <div class="mb-4">
                        <label for="subkriteria" class="block text-sm font-medium text-gray-700 mb-2">Nama Subkriteria:</label>
                        <input
                            type="text"
                            id="subkriteria"
                            name="subkriteria"
                            class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('subkriteria') border-red-500 @enderror"
                            value="{{ old('subkriteria') }}"
                            placeholder="Contoh: Pengalaman 1-3 tahun"
                            required
                        >
                        @error('subkriteria')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input untuk Nilai Ideal --}}
                    <div class="mb-4">
                        <label for="nilai_ideal" class="block text-sm font-medium text-gray-700 mb-2">Nilai Ideal:</label>
                        <input
                            type="number"
                            id="nilai_ideal"
                            name="nilai_ideal"
                            class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('nilai_ideal') border-red-500 @enderror"
                            value="{{ old('nilai_ideal') }}"
                            placeholder="Contoh: 80"
                            required
                            min="1" max="5" {{-- Sesuaikan min/max sesuai validasi controller --}}
                        >
                        @error('nilai_ideal')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Radio Buttons untuk Tipe Faktor (Core/Secondary) --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Faktor:</label>
                        <div class="flex items-center space-x-4">
                            <label class="inline-flex items-center">
                                <input
                                    type="radio"
                                    name="factor_type"
                                    value="core"
                                    class="form-radio h-5 w-5 text-blue-600"
                                    {{ old('factor_type', 'core') == 'core' ? 'checked' : '' }} {{-- Default "Core Factor" dipilih --}}
                                    required
                                >
                                <span class="ml-2 text-gray-700">Core Factor</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input
                                    type="radio"
                                    name="factor_type"
                                    value="secondary"
                                    class="form-radio h-5 w-5 text-purple-600"
                                    {{ old('factor_type') == 'secondary' ? 'checked' : '' }}
                                    required
                                >
                                <span class="ml-2 text-gray-700">Secondary Factor</span>
                            </label>
                        </div>
                        @error('factor_type')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Textarea untuk Keterangan --}}
                    <div class="mb-6">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan:</label>
                        <textarea
                            id="keterangan"
                            name="keterangan"
                            rows="4"
                            class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('keterangan') border-red-500 @enderror"
                            placeholder="Masukkan keterangan tambahan (opsional)..."
                        >{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-200">
                        <a href="{{ route('subkriteria.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-150 ease-in-out">
                            Simpan Subkriteria
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
