<x-mycomponents.layoutmahasiswa>
    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-20">
        <h1 class="text-2xl font-semibold mb-4">Presensi Mahasiswa</h1>

        {{-- Alert Message --}}
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
        @elseif (session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
        @elseif (session('warning'))
            <div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">{{ session('warning') }}</div>
        @endif

        @if ($jadwalHariIni->isEmpty())
            <div class="p-4 bg-gray-50 rounded text-gray-600">
                Tidak ada jadwal kuliah hari ini.
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($jadwalHariIni as $jadwal)
                    <div class="border rounded-lg p-4 bg-white shadow" x-data="{
                        showForm: false,
                        token: '',
                        jadwalId: {{ $jadwal->id }}
                    }">
                        <h2 class="font-semibold text-lg">
                            {{ $jadwal->mataKuliah->nama_mk }}
                        </h2>

                        <p class="text-sm text-gray-600">
                            Dosen: {{ $jadwal->dosen->nama_dosen }} <br>
                            Jam:
                            {{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}
                            -
                            {{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}
                        </p>

                        <button @click="showForm = !showForm"
                            class="mt-3 bg-blue-600 hover:bg-blue-700 text-white text-sm px-3 py-2 rounded">
                            Presensi Sekarang
                        </button>

                        <form x-show="showForm" x-transition method="POST"
                            action="{{ route('presensi_mahasiswa.store') }}" class="mt-3 space-y-2">
                            @csrf

                            <input type="hidden" name="jadwal_id" :value="jadwalId">

                            <input type="text" name="token" x-model="token" placeholder="Masukkan Token"
                                class="w-full border rounded p-2 text-sm focus:outline-none focus:ring focus:ring-blue-200"
                                required>

                            <button type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white text-sm px-3 py-2 rounded">
                                Kirim Presensi
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @endif
    </main>
</x-mycomponents.layoutmahasiswa>
