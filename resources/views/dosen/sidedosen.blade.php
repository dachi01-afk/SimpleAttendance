<div class="h-full px-3 pb-4 overflow-y-auto">
    <ul class="space-y-2 font-medium">
        <!-- DASHBOARD -->
        <li>
            <a href="{{ route('dosen.dashboard') }}"
                class="sidebar-link flex items-center p-2 rounded-lg 
                {{ request()->routeIs('admin.dashboard') ? 'bg-kampus-utama text-white' : 'text-white hover:bg-kampus-utama' }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10" />
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>

        <!-- Jadwal Mengajar -->
        <li>
            <a href="#" class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 7V3m8 4V3m-9 8h10M5 20h14a2 2 0 002-2V7H3v11a2 2 0 002 2z" />
                </svg>
                <span class="ms-3">Jadwal Mengajar</span>
            </a>
        </li>

        <!-- Buat Token Presensi -->
        <li>
            <a href="#" class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 11V7m0 4v4m0-4h4m-4 0H8m8-7H8a2 2 0 00-2 2v14l6-3 6 3V6a2 2 0 00-2-2z" />
                </svg>
                <span class="ms-3">Buat Token Presensi</span>
            </a>
        </li>

        <!-- Data Mata Kuliah -->
        <li>
            <a href="#" class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20l9-5-9-5-9 5 9 5zM3 10l9-5 9 5" />
                </svg>
                <span class="ms-3">Data Mata Kuliah</span>
            </a>
        </li>

        <!-- Presensi Dosen -->
        <li>
            <a href="#" class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 14a9 9 0 100-18 9 9 0 000 18zm0 0v7m0-7H9m3 0h3" />
                </svg>
                <span class="ms-3">Presensi Dosen</span>
            </a>
        </li>

        <!-- Laporan Presensi -->
        <li>
            <a href="#" class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 17v-2h6v2m-7-8h8m-8 4h8M5 4h14a2 2 0 012 2v12a2 2 0 01-2 2H5a2 2 0 01-2-2V6a2 2 0 012-2z" />
                </svg>
                <span class="ms-3">Laporan Presensi</span>
            </a>
        </li>
    </ul>

</div>
