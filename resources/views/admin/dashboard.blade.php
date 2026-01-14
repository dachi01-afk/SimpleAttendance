<x-mycomponents.layoutadmin>

    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2">
        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Dashboard</h1>
        </nav>


        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-6">Selamat Datang di Sistem Presensi Kampus</h1>

            <!-- Quick Info Cards (Statistik Cepat) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Card 1: Total Mahasiswa -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border border-kampus-terang hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Mahasiswa</p>
                            <p class="text-3xl font-extrabold text-kampus-gelap">{{ $totalMahasiswa }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-kampus-terang text-kampus-gelap">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-3a3 3 0 00-5.356-1.857M17 20v-2a3 3 0 00-5.356-1.857M17 20h-5m2-9a4 4 0 11-8 0 4 4 0 018 0zM7 13a3 3 0 00-3 3v1a2 2 0 002 2h4M7 13a4 4 0 100-8 4 4 0 000 8z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Dosen -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border border-kampus-terang hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Dosen</p>
                            <p class="text-3xl font-extrabold text-kampus-gelap">{{ $totalDosen }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-kampus-terang text-kampus-gelap">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 6H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-5m-9-5l6-6m0 0l6 6m-6-6v12">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Total Kelas -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border border-kampus-terang hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Total Kelas</p>
                            <p class="text-3xl font-extrabold text-green-600">{{ $totalKelas }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-green-100 text-green-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.047A12.007 12.007 0 002.944 12c-.504 3.045 1.488 5.615 4.533 6.666m1.218-11.751A10.02 10.02 0 0012 3.966a10.02 10.02 0 002.247 1.206m-2.247-1.206V21">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Mata Kuliah Aktif -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border border-kampus-terang hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Mata Kuliah Aktif</p>
                            <p class="text-3xl font-extrabold text-yellow-600">{{ $totalMataKuliah }}</p>
                        </div>
                        <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13a4.2 4.2 0 000 8.4m0-8.4a4.2 4.2 0 110 8.4m-4.2 8.4h8.4M18 10a4.2 4.2 0 000-8.4m0 8.4a4.2 4.2 0 010-8.4">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Column: Upcoming Classes/Attendance Today -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200 overflow-x-auto">
                {{-- <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200 overflow-x-auto"> --}}
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Presensi Hari Ini - <span
                        class="text-kampus-utama">{{ $namaHari }}</span></h2>

                {{-- data tabel --}}
                <div class="w-full overflow-x-auto">
                    <table id="jadwalKuliahTableAdminDashboard" class="display min-w-full border border-gray-200">
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
                                <tr class="even:bg-gray-100">
                                    <td class="px-4 py-2">{{ $jadwal->dosen->nama_dosen }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->mataKuliah->nama_mk }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->kelas->nama_kelas }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->nama_hari }}</td>
                                    <td class="px-4 py-2 text-center whitespace-nowrap">
                                        {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                        {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                    </td>
                                    <td class="px-4 py-2">{{ $jadwal->semester }}</td>
                                    <td class="px-4 py-2">{{ $jadwal->tahun_ajaran }}</td>
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

            </div>

            <!-- Spacer for Footer -->
            <div class="h-16"></div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#jadwalKuliahTableAdminDashboard').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>

</x-mycomponents.layoutadmin>
