<x-mycomponents.layoutdosen>
    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-4">
        <h1 class="text-2xl font-semibold text-gray-800 mb-4">Generate Token Presensi</h1>

        @if (session('success'))
            <div class="p-3 mb-4 bg-green-100 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form Generate Token -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6">
            <form action="{{ route('token_presensi.generate') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="jadwal_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Pilih Mata Kuliah
                    </label>
                    <select name="jadwal_id" id="jadwal_id" class="w-full border-gray-300 rounded-lg">
                        <option value="">-- Pilih Jadwal --</option>
                        @foreach ($jadwals as $jadwal)
                            <option value="{{ $jadwal->id }}">
                                {{ $jadwal->mataKuliah->nama_mk }} - {{ $jadwal->kelas->nama_kelas }}
                                ({{ $jadwal->hari }} | {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                {{ date('H:i', strtotime($jadwal->jam_selesai)) }})
                            </option>
                        @endforeach
                    </select>
                    @error('jadwal_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="durasi" class="block text-sm font-medium text-gray-700 mb-1">
                        Durasi Token Aktif (menit)
                    </label>
                    <input type="number" name="durasi" id="durasi" class="w-full border-gray-300 rounded-lg"
                        placeholder="Contoh: 15" min="1" required>
                    @error('durasi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow">
                        Generate Token
                    </button>
                </div>
            </form>
        </div>

        <!-- Token Aktif -->
        @if ($tokenAktif)
            <div class="bg-white shadow-md rounded-xl p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Token Aktif Saat Ini</h2>
                <p class="text-4xl font-bold text-blue-600 tracking-widest mb-3">
                    {{ $tokenAktif->token }}
                </p>
                <p class="text-sm text-gray-600">
                    Berlaku hingga: {{ $tokenAktif->waktu_selesai->format('H:i:s d/m/Y') }}
                </p>
            </div>
        @endif
    </main>
</x-mycomponents.layoutdosen>
