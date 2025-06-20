@extends('layouts.main')

@section('content')
    <main id="content" class="p-6 pt-20 lg:pt-6 lg:ml-64 min-h-screen">
        <div class="bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Penilaian Karyawan: <span class="text-blue-600">{{ $user->name }}</span></h2>

            <form action="{{ route('penilaian.store', $user->id) }}" method="POST">
                @csrf

                <div class="space-y-6">
                    {{-- Informasi Karyawan (Otomatis) --}}
                    <div class="mb-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="text-xl font-semibold mb-2 text-gray-700">Detail Karyawan</h3>
                        <p class="text-gray-700"><strong>Nama:</strong> {{ $user->name }}</p>
                        <p class="text-gray-700"><strong>NIK:</strong> {{ $user->nik }}</p>
                        <p class="text-gray-700"><strong>Jabatan:</strong> {{ $user->jabatan->jabatan ?? 'N/A' }}</p>
                        <p class="text-gray-700"><strong>Pekerjaan:</strong> {{ $user->pekerjaan->pekerjaan ?? 'N/A' }}</p>
                    </div>

                    <hr class="my-4 border-gray-300">

                    {{-- Looping Kriteria dan Subkriteria --}}
                    @forelse($kriterias as $kriteria)
                        <div class="mb-6 p-6 border border-gray-200 rounded-lg bg-gray-50 shadow-sm">
                            <h3 class="text-xl font-semibold mb-4 text-gray-800 border-b pb-2">Kriteria {{ $loop->iteration }}: {{ $kriteria->kriteria }}</h3>

                            @forelse($kriteria->subkriterias as $subkriteria)
                                <div class="flex flex-col md:flex-row md:items-center md:justify-between p-3 bg-white rounded-md shadow-sm mb-2">
                                    <label for="nilai_aktual_{{ $subkriteria->id }}" class="block text-gray-700 font-medium md:w-1/2 mr-4 mb-2 md:mb-0">
                                        Sub Kriteria {{ $loop->parent->iteration }}.{{ $loop->iteration }}: {{ $subkriteria->subkriteria }}
                                        <span class="text-gray-500 text-sm">(Ideal: {{ $subkriteria->nilai_ideal }})</span>
                                        @if ($subkriteria->is_core_factor)
                                            <span class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Core Factor</span>
                                        @else
                                            <span class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-purple-100 text-purple-800">Secondary Factor</span>
                                        @endif
                                    </label>

                                    <div class="flex items-center md:w-1/2">
                                        <select
                                            id="nilai_aktual_{{ $subkriteria->id }}"
                                            name="nilai_aktual[{{ $subkriteria->id }}]"
                                            class="shadow-sm appearance-none border rounded-lg w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-blue-500 focus:border-blue-500 transition duration-150 ease-in-out @error('nilai_aktual.' . $subkriteria->id) border-red-500 @enderror"
                                            required
                                        >
                                            <option value="">-- Pilih Nilai --</option>
                                            <option value="1" {{ old('nilai_aktual.' . $subkriteria->id, $existingPenilaian[$subkriteria->id] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                            <option value="2" {{ old('nilai_aktual.' . $subkriteria->id, $existingPenilaian[$subkriteria->id] ?? '') == '2' ? 'selected' : '' }}>2</option>
                                            <option value="3" {{ old('nilai_aktual.' . $subkriteria->id, $existingPenilaian[$subkriteria->id] ?? '') == '3' ? 'selected' : '' }}>3</option>
                                            <option value="4" {{ old('nilai_aktual.' . $subkriteria->id, $existingPenilaian[$subkriteria->id] ?? '') == '4' ? 'selected' : '' }}>4</option>
                                            <option value="5" {{ old('nilai_aktual.' . $subkriteria->id, $existingPenilaian[$subkriteria->id] ?? '') == '5' ? 'selected' : '' }}>5</option>
                                        </select>
                                        @error('nilai_aktual.' . $subkriteria->id)
                                            <p class="text-red-500 text-xs italic ml-4 mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500">Tidak ada subkriteria untuk kriteria ini.</p>
                            @endforelse
                        </div>
                    @empty
                        <p class="text-gray-500 text-center">Belum ada kriteria atau subkriteria yang terdaftar.</p>
                    @endforelse

                    <div class="flex items-center justify-between mt-8 pt-4 border-t border-gray-200">
                        <a href="{{ route('penilaian.index') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-100 transition duration-150 ease-in-out">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 shadow-md transition duration-150 ease-in-out">
                            Simpan Penilaian
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
