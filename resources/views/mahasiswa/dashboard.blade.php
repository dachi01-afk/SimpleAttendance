<x-mycomponents.layoutmahasiswa>

    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-4">

        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
        </nav>

        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Selamat Datang di Sistem Presensi Kampus</h1>

            <!-- Statistik Cepat -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                <!-- Total Mahasiswa -->
                <div class="bg-white p-6 rounded-xl shadow-lg border hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Total Mahasiswa</p>
                            <p class="text-3xl font-extrabold text-blue-700">{{ $totalMahasiswa }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-blue-100 text-blue-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-3a3 3 0 00-5.356-1.857M17 20v-2a3 3 0 00-5.356-1.857M17 20h-5m2-9a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Dosen -->
                <div class="bg-white p-6 rounded-xl shadow-lg border hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Total Dosen</p>
                            <p class="text-3xl font-extrabold text-indigo-700">{{ $totalDosen }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-indigo-100 text-indigo-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 11c0-1.657-1.343-3-3-3S6 9.343 6 11s1.343 3 3 3 3-1.343 3-3zM6 11v6m3-6v6m3 0H3" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Kelas -->
                <div class="bg-white p-6 rounded-xl shadow-lg border hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Total Kelas</p>
                            <p class="text-3xl font-extrabold text-green-600">{{ $totalKelas }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.047A12.007 12.007 0 002.944 12c-.504 3.045 1.488 5.615 4.533 6.666" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Mata Kuliah -->
                <div class="bg-white p-6 rounded-xl shadow-lg border hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-500 uppercase font-medium">Mata Kuliah Aktif</p>
                            <p class="text-3xl font-extrabold text-yellow-600">{{ $totalMataKuliah }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Jadwal Kuliah Hari Ini -->
            <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 overflow-x-auto">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                    Jadwal Kuliah Hari Ini - <span class="text-blue-600">{{ $namaHari }}</span>
                </h2>

                <table id="jadwalKuliahTableMahasiswaDashboard" class="min-w-full border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-center">Dosen</th>
                            <th class="px-4 py-2 text-center">Mata Kuliah</th>
                            <th class="px-4 py-2 text-center">Kelas</th>
                            <th class="px-4 py-2 text-center">Hari</th>
                            <th class="px-4 py-2 text-center">Jam</th>
                            <th class="px-4 py-2 text-center">Semester</th>
                            <th class="px-4 py-2 text-center">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                            <tr class="even:bg-gray-100 hover:bg-gray-50 transition">
                                <td class="px-4 py-2 text-center">{{ $jadwal->dosen->nama_dosen }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->mataKuliah->nama_mk }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->kelas->nama_kelas }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->nama_hari }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">
                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                    {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                </td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->semester }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->tahun_ajaran }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    Tidak ada jadwal kuliah hari ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="h-16"></div> <!-- Spacer -->
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#jadwalKuliahTableMahasiswaDashboard').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true,
                        pageLength: 5,
                        language: {
                            url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                        }
                    });
                });
            </script>
        @endpush
    </main>

</x-mycomponents.layoutmahasiswa>
