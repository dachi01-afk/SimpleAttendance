<x-mycomponents.layoutdosen>
    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2" x-data="{
        openEdit: false,
        editData: {},
        presensis: [],
        selectedMatkul: ''
    }" x-init="$watch('selectedMatkul', async value => {
        if (value) {
            try {
                const res = await fetch(`/dosen/daftar_presensi_mahasiswa/${value}`);
                const data = await res.json();
                presensis = data.data || [];
            } catch (e) {
                alert('Gagal memuat data presensi');
            }
        } else {
            presensis = [];
        }
    });">

        <!-- Breadcrumb -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Daftar Presensi Mahasiswa</h1>
        </nav>

        <!-- Pilih Mata Kuliah -->
        <div class="mb-4">
            <label for="matkul" class="block mb-2 text-sm font-medium text-gray-700">Pilih Mata Kuliah</label>
            <select id="matkul" x-model="selectedMatkul"
                class="border border-gray-300 text-gray-700 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option value="">-- Pilih Mata Kuliah --</option>
                @foreach ($jadwal_dosen as $jadwal)
                    <option value="{{ $jadwal->id }}">
                        {{ $jadwal->mataKuliah->nama_mk }} - {{ $jadwal->kelas->nama_kelas }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- DataTable -->
        <div class="container">
            <table id="presensiTable" class="display min-w-full border border-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">No</th>
                        <th class="px-4 py-2 text-center">Nama Mahasiswa</th>
                        <th class="px-4 py-2 text-center">NIM</th>
                        <th class="px-4 py-2 text-center">Waktu Presensi</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <template x-if="presensis.length === 0">
                        <tr>
                            <td colspan="6" class="text-center text-gray-500 py-4">
                                Belum ada data presensi hari ini.
                            </td>
                        </tr>
                    </template>
                    <template x-for="(p, index) in presensis" :key="p.id">
                        <tr class="even:bg-gray-100">
                            <td class="px-4 py-2 text-center" x-text="index + 1"></td>
                            <td class="px-4 py-2" x-text="p.mahasiswa?.nama_mahasiswa"></td>
                            <td class="px-4 py-2 text-center" x-text="p.mahasiswa?.nim"></td>
                            <td class="px-4 py-2 text-center" x-text="p.waktu_presensi"></td>
                            <td class="px-4 py-2 text-center">
                                <span x-text="p.status"
                                    :class="{
                                        'text-green-600 font-semibold': p.status === 'hadir',
                                        'text-blue-600 font-semibold': p.status === 'sakit',
                                        'text-yellow-600 font-semibold': p.status === 'izin',
                                        'text-red-600 font-semibold': p.status === 'alpha'
                                    }"></span>
                            </td>
                            <td class="px-4 py-2 text-center">
                                <button @click="openEdit = true; editData = p"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Ubah Status
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>

        <!-- Modal Edit Status -->
        <div x-show="openEdit" x-cloak @keydown.escape.window="openEdit=false"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="openEdit=false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-xl font-semibold mb-4">Ubah Status Presensi</h2>

                <form
                    @submit.prevent="async () => {
                        try {
                            const res = await fetch(`/dosen/daftar_presensi_mahasiswa/${editData.id}/update-status`, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({ status: editData.status })
                            });
                            if (!res.ok) throw new Error('Gagal update');
                            alert('Status berhasil diperbarui');
                            openEdit = false;

                            // Refresh data otomatis setelah update
                            const res2 = await fetch(`/dosen/daftar_presensi_mahasiswa/${selectedMatkul}`);
                            const data = await res2.json();
                            presensis = data.data || [];

                        } catch (e) {
                            alert('Terjadi kesalahan saat memperbarui status');
                        }
                    }">

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Nama Mahasiswa</label>
                        <p class="font-medium" x-text="editData.mahasiswa?.nama_mahasiswa"></p>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Status</label>
                        <select x-model="editData.status"
                            class="w-full border rounded p-2 text-gray-700 focus:ring-blue-500 focus:border-blue-500">
                            <option value="hadir">Hadir</option>
                            <option value="sakit">Sakit</option>
                            <option value="izin">Izin</option>
                            <option value="alpha">Alpha</option>
                        </select>
                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openEdit=false"
                            class="px-4 py-2 bg-gray-400 text-white rounded">Batal</button>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#presensiTable').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>
</x-mycomponents.layoutdosen>
