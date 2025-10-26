<x-mycomponents.layoutdosen>

    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-20">
        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-kampus-utama rounded-lg">
                        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 20">
                            <path
                                d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z" />
                        </svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="ms-1 text-sm font-medium text-kampus-utama md:ms-2">Dashboard</span>
                    </div>
                </li>
            </ol>
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
                            <p class="text-3xl font-extrabold text-kampus-gelap">5,421</p>
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
                            <p class="text-3xl font-extrabold text-kampus-gelap">189</p>
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

                <!-- Card 3: Kehadiran Hari Ini (Mahasiswa) -->
                <div
                    class="bg-white p-6 rounded-xl shadow-lg border border-kampus-terang hover:shadow-xl transition duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500 uppercase">Hadir Hari Ini</p>
                            <p class="text-3xl font-extrabold text-green-600">92%</p>
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
                            <p class="text-3xl font-extrabold text-yellow-600">345</p>
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

            <!-- Main Content Section: Today's Attendance List -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- Left Column: Upcoming Classes/Attendance Today -->
                <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Presensi Hari Ini - <span
                            class="text-kampus-utama">Senin, 17 Okt 2025</span></h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Waktu</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Mata Kuliah</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Dosen</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <!-- Example Row 1 -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">08:00 - 09:30
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-kampus-utama">
                                        Struktur
                                        Data (A)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Andi Wijaya
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button
                                            class="bg-kampus-utama text-white px-3 py-1 rounded-lg text-xs font-semibold hover:bg-kampus-gelap transition duration-200">
                                            Mulai Presensi
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Belum Dimulai
                                        </span>
                                    </td>
                                </tr>
                                <!-- Example Row 2 (In Progress) -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">10:00 - 11:30
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-kampus-utama">
                                        Kalkulus
                                        Lanjut (B)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Prof. Budi
                                        Santoso
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button
                                            class="bg-red-500 text-white px-3 py-1 rounded-lg text-xs font-semibold hover:bg-red-700 transition duration-200">
                                            Selesaikan
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800 animate-pulse">
                                            Sedang Berlangsung
                                        </span>
                                    </td>
                                </tr>
                                <!-- Example Row 3 (Done) -->
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">13:00 - 14:30
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-kampus-utama">
                                        Pemrograman Web (C)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ibu Citra Dewi,
                                        M.Kom
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <button disabled
                                            class="bg-gray-300 text-gray-600 px-3 py-1 rounded-lg text-xs font-semibold cursor-not-allowed">
                                            Selesai
                                        </button>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Selesai
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

                <!-- Right Column: Recent Activities / Quick Action -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Quick Action Card -->
                    <div class="bg-kampus-gelap p-6 rounded-xl shadow-lg border border-kampus-utama text-white">
                        <h3 class="text-xl font-bold mb-3">Aksi Cepat</h3>
                        <p class="text-sm text-gray-300 mb-4">Buat sesi presensi baru untuk mata kuliah yang
                            mendesak.
                        </p>
                        <button
                            class="w-full bg-green-500 text-white font-bold py-2 rounded-lg hover:bg-green-600 transition duration-200 shadow-md">
                            <svg class="w-5 h-5 inline mr-1 -mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Buat Sesi Baru
                        </button>
                    </div>

                    <!-- Recent Activities Card -->
                    <div class="bg-white p-6 rounded-xl shadow-lg border border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Aktivitas Terbaru</h3>
                        <ul class="space-y-3">
                            <li class="flex items-start space-x-3">
                                <div class="flex-shrink-0 pt-1">
                                    <span class="flex w-2.5 h-2.5 bg-green-500 rounded-full"></span>
                                </div>
                                <p class="text-sm text-gray-700">
                                    <span class="font-semibold">Budi S.</span> telah mengakhiri Presensi Matkul
                                    Logika.
                                    <span class="block text-xs text-gray-500 mt-0.5">5 menit yang lalu</span>
                                </p>
                            </li>
                            <li class="flex items-start space-x-3">
                                <div class="flex-shrink-0 pt-1">
                                    <span class="flex w-2.5 h-2.5 bg-kampus-utama rounded-full"></span>
                                </div>
                                <p class="text-sm text-gray-700">
                                    <span class="font-semibold">Sistem</span> telah menambahkan 25 Mahasiswa baru.
                                    <span class="block text-xs text-gray-500 mt-0.5">1 jam yang lalu</span>
                                </p>
                            </li>
                            <li class="flex items-start space-x-3">
                                <div class="flex-shrink-0 pt-1">
                                    <span class="flex w-2.5 h-2.5 bg-yellow-500 rounded-full"></span>
                                </div>
                                <p class="text-sm text-gray-700">
                                    <span class="font-semibold">Ibu Citra D.</span> membuat Presensi Matkul
                                    Pemrograman
                                    Web.
                                    <span class="block text-xs text-gray-500 mt-0.5">2 jam yang lalu</span>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Spacer for Footer -->
            <div class="h-16"></div>
        </div>

    </main>

</x-mycomponents.layoutdosen>
