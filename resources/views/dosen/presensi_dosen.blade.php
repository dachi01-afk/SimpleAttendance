<x-mycomponents.layoutdosen>
    <main class="p-4 lg:ml-64 mt-16">

        <h1 class="text-2xl font-semibold mb-4">Presensi Dosen Hari Ini</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-3">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-3">{{ session('error') }}</div>
        @endif

        @if (!$presensi)
            <!-- Belum presensi -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                <p class="text-gray-700 mb-4">Anda belum melakukan presensi hari ini.</p>
                <div class="space-x-2">
                    <form action="{{ route('presensi_dosen.checkin') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                            Presensi Masuk
                        </button>
                    </form>
                    <button @click="openIzin = true"
                        class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded">
                        Izin / Sakit
                    </button>
                </div>
            </div>
        @elseif ($presensi && !$presensi->jam_pulang)
            <!-- Sudah presensi masuk -->
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-4">
                <p class="text-blue-700 font-semibold">Anda sudah presensi masuk pada:
                    {{ \Carbon\Carbon::parse($presensi->jam_masuk)->format('H:i') }}</p>
            </div>

            <form action="{{ route('presensi_dosen.checkout') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                    Presensi Pulang
                </button>
            </form>
        @else
            <!-- Sudah presensi pulang -->
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-4">
                <p class="text-green-700 font-semibold">Presensi selesai 🎉</p>
                <p>Jam Masuk: {{ \Carbon\Carbon::parse($presensi->jam_masuk)->format('H:i') }}</p>
                <p>Jam Pulang: {{ \Carbon\Carbon::parse($presensi->jam_pulang)->format('H:i') }}</p>
                <p>Status: <span class="font-bold text-green-600">{{ ucfirst($presensi->status) }}</span></p>
            </div>
        @endif

        <!-- Modal Izin -->
        <div x-data="{ openIzin: false }">
            <div x-show="openIzin" x-cloak
                class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
                <div @click.away="openIzin = false" class="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                    <h2 class="text-lg font-semibold mb-3">Form Izin / Sakit</h2>
                    <form action="{{ route('presensi_dosen.izin') }}" method="POST">
                        @csrf
                        <label class="block text-gray-700 mb-2">Pilih Status:</label>
                        <select name="status" class="w-full border p-2 rounded mb-3">
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                        </select>

                        <label class="block text-gray-700 mb-2">Keterangan:</label>
                        <textarea name="keterangan" class="w-full border rounded p-2 mb-3" required></textarea>

                        <div class="flex justify-end space-x-2">
                            <button type="button" @click="openIzin = false"
                                class="px-3 py-1 bg-gray-400 text-white rounded">Batal</button>
                            <button type="submit"
                                class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-mycomponents.layoutdosen>
