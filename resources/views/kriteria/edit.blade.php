@extends('layouts.main')
@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Edit Data Kriteria</h2>

            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Input Nama Kriteria --}}
                    <div class="mb-4">
                        <label for="kriteria" class="block text-sm font-medium text-gray-700 mb-2">Nama Kriteria</label>
                        <input
                            type="text"
                            id="kriteria"
                            name="kriteria"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 ease-in-out @error('kriteria') @enderror"
                            value="{{ old('kriteria', $kriteria->kriteria) }}"
                            placeholder="Masukkan nama kriteria"
                        >
                        @error('kriteria')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Input Bobot Core Factor (%) --}}
                    <div class="mb-4">
                        <label for="bobot_kriteria" class="block text-sm font-medium text-gray-700 mb-2">Bobot Core Factor (%)</label>
                        <input
                            type="number"
                            id="bobot_kriteria"
                            name="bobot_kriteria"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 ease-in-out @error('bobot_kriteria') @enderror"
                            value="{{ old('bobot_kriteria', $kriteria->bobot_kriteria) }}"
                            placeholder="Contoh: 60 (untuk 60%)"
                            min="0" max="100"
                        >
                        @error('bobot_kriteria')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Output Bobot Secondary Factor (Otomatis) --}}
                    <div class="mb-4">
                        <label for="secondary_factor_display" class="block text-sm font-medium text-gray-700 mb-2">Bobot Secondary Factor (%)</label>
                        <input
                            type="text"
                            id="secondary_factor_display"
                            class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg shadow-sm cursor-not-allowed"
                            value="0%"
                            readonly
                        >
                        <p class="text-sm text-gray-500 mt-1">Nilai ini dihitung otomatis (100% - Bobot Core Factor).</p>
                    </div>

                    {{-- Textarea Keterangan --}}
                    <div class="mb-6">
                        <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-2">Keterangan</label>
                        <textarea
                            id="keterangan"
                            name="keterangan"
                            rows="4"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 outline-none transition duration-150 ease-in-out @error('keterangan') @enderror"
                            placeholder="Keterangan tambahan (opsional)"
                        >{{ old('keterangan', $kriteria->keterangan) }}</textarea>
                        @error('keterangan')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-8 pt-4 flex justify-end space-x-4 border-t border-gray-200">
                        <a href="{{ route('kriteria.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-150 ease-in-out">
                            Perbarui Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        // JavaScript untuk menghitung Secondary Factor secara otomatis
        document.addEventListener('DOMContentLoaded', function() {
            const bobotCoreFactorInput = document.getElementById('bobot_kriteria');
            const secondaryFactorDisplay = document.getElementById('secondary_factor_display');

            function calculateSecondaryFactor() {
                let coreFactorValue = parseInt(bobotCoreFactorInput.value);

                if (isNaN(coreFactorValue) || coreFactorValue < 0) {
                    coreFactorValue = 0;
                }
                if (coreFactorValue > 100) {
                    coreFactorValue = 100;
                }

                const secondaryFactorValue = 100 - coreFactorValue;
                secondaryFactorDisplay.value = secondaryFactorValue + '%';
            }

            calculateSecondaryFactor(); // Panggil saat halaman dimuat
            bobotCoreFactorInput.addEventListener('input', calculateSecondaryFactor); // Panggil setiap kali input berubah
        });
    </script>
@endsection
