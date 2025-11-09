<div class="h-full px-3 pb-4 overflow-y-auto">
    <ul class="space-y-2 font-medium">
        <li>
            <a href="{{ route('mahasiswa.dashboard') }}"
                class="sidebar-link flex items-center p-2 rounded-lg 
                {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-kampus-utama text-white' : 'text-white hover:bg-kampus-utama' }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l9-9 9 9M4 10v10h5v-6h6v6h5V10" />
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
        </li>

        <!-- Daftar Matakuliah -->
        <li>
            <a href="{{ route('mahasiswa.data_matakuliah') }}"
                class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg
            {{ request()->routeIs('mahasiswa.data_matakuliah') ? 'bg-kampus-utama text-white' : 'text-white hover:bg-kampus-utama' }}">
                <svg class="w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20l9-5-9-5-9 5 9 5zM3 10l9-5 9 5" />
                </svg>
                <span class="ms-3">Data Mata Kuliah</span>
            </a>
        </li>

        <!-- Presensi -->
        <li>
            <a href="{{ route('mahasiswa.presensi_mahasiswa') }}"
                class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg
            {{ request()->routeIs('mahasiswa.presensi_mahasiswa') ? 'bg-kampus-utama text-white' : 'text-white hover:bg-kampus-utama' }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <!-- Check Circle icon -->
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m1-5a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ms-3">Presensi</span>
            </a>
        </li>

        <!-- Riwayat Presensi -->
        <li>
            <a href="{{ route('mahasiswa.riwayat_presensi') }}"
                class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg
            {{ request()->routeIs('mahasiswa.riwayat_presensi') ? 'bg-kampus-utama text-white' : 'text-white hover:bg-kampus-utama' }}">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <!-- Clock icon -->
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 8v4l3 3m6 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="ms-3">Riwayat Presensi</span>
            </a>
        </li>
    </ul>

</div>
