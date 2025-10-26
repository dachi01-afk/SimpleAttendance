<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Presensi Kampus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Load Flowbite JS (for components like mobile sidebar/drawer) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <style>
        /* Custom Font - Inter (Tailwind default is good, but explicitly setting it) */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7f9fb;
            /* Light background for body */
        }

        /* Style for the main content area padding adjustment */
        #main-content {
            transition: margin-left 0.3s;
        }

        /* Ensures the sidebar links are clearly visible */
        .sidebar-link {
            transition: all 0.2s;
        }

        .sidebar-link:hover {
            background-color: #1e40af;
            /* Darker blue on hover */
            color: #ffffff;
            border-radius: 0.5rem;
        }
    </style>
</head>

<body class="bg-gray-50 antialiased">

    <!-- 1. NAVIGATION BAR (Header) -->
    <header class="fixed top-0 left-0 right-0 z-40 bg-white border-b border-gray-200 shadow-sm">
        <div class="px-4 py-3 lg:px-6 lg:py-4">
            <div class="flex items-center justify-between">
                <!-- Logo & Mobile Menu Button (Left Side) -->
                <div class="flex items-center space-x-4">
                    <!-- Mobile Sidebar Toggle -->
                    <button id="toggle-sidebar-mobile" onclick="toggleSidebar()" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                        <span class="sr-only">Buka menu samping</span>
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 1h15M1 7h15M1 13h15" />
                        </svg>
                    </button>

                    <!-- Logo Placeholder (SUDUT KIRI ATAS) -->
                    <a href="#" class="flex items-center space-x-2">
                        <!-- Placeholder for Campus Logo -->
                        <div
                            class="w-8 h-8 rounded-full bg-kampus-utama flex items-center justify-center text-white font-bold text-xl">
                            <span class="text-xs">LOGO</span>
                        </div>
                        <span class="text-xl font-semibold whitespace-nowrap text-gray-900 hidden sm:inline">Presensi
                            Kampus</span>
                    </a>
                </div>

                <!-- User Profile & Notifications (Right Side) -->
                <div class="flex items-center space-x-3">
                    <!-- Notifications Icon -->
                    <button type="button"
                        class="p-2 text-gray-500 rounded-full hover:bg-gray-100 focus:ring-4 focus:ring-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                            </path>
                        </svg>
                    </button>
                    <!-- Profile Dropdown -->
                    <div class="relative">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button
                                    class="flex items-center space-x-2 cursor-pointer p-1 rounded-full hover:bg-gray-100 focus:outline-none transition">
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://placehold.co/32x32/1e40af/ffffff?text=U" alt="Foto Profil">
                                    <span class="text-sm font-medium text-gray-900 hidden md:inline">
                                        {{ Auth::user()->name ?? 'Admin' }}
                                    </span>
                                    <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <!-- 2. SIDEBAR (Navigation Menu) -->
    <!-- Mobile overlay (Hidden by default, shown when sidebar opens on mobile) -->
    <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 z-30 bg-gray-900/50 hidden lg:hidden"></div>



    <aside id="sidebar"
        class="fixed top-[64px] left-0 z-40 w-64 h-[calc(100%-64px)] pt-4 transition-transform -translate-x-full bg-kampus-gelap text-white overflow-y-auto lg:translate-x-0"
        aria-label="Menu Samping">
        <div class="h-full px-3 pb-4 overflow-y-auto">
            <ul class="space-y-2 font-medium">
                <!-- DASHBOARD -->
                <li>
                    <a href="#" class="sidebar-link flex items-center p-2 text-white bg-kampus-utama rounded-lg">
                        <svg class="w-5 h-5 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11 2.1c.5-.5 1.1-.5 1.6 0l9 8.2c.4.4.6.9.6 1.5v7.5a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3v-7.5c0-.6.2-1.1.6-1.5l9-8.2Z"
                                clip-rule="evenodd" />
                            <path d="M10 13c0 .6.4 1 1 1h2c.6 0 1-.4 1-1v-2h-4v2Z" />
                        </svg>
                        <span class="ms-3">Dashboard Utama</span>
                    </a>
                </li>
                <!-- PRESENSI -->
                <li>
                    <a href="#"
                        class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M8 6V5c0-1.1.9-2 2-2h4a2 2 0 0 1 2 2v1h1a3 3 0 0 1 3 3v7a3 3 0 0 1-3 3h-2v-3a3 3 0 0 0-3-3H9a3 3 0 0 0-3 3v3H4a3 3 0 0 1-3-3V9a3 3 0 0 1 3-3h4Zm2-3a1 1 0 0 0-1 1v1h6V4a1 1 0 0 0-1-1h-4Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M12 17a1 1 0 0 1 1 1v3h2a3 3 0 0 0 3-3v-2H12Zm-2 0H6v-2a3 3 0 0 0-3 3v2h2a1 1 0 0 0 1-1v-1a1 1 0 0 1 1-1h3Zm0-5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Rekap Presensi</span>
                    </a>
                </li>
                <!-- JADWAL KULIAH -->
                <li>
                    <a href="#"
                        class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path d="M12 14v4m-4 1h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2Z" />
                            <path fill-rule="evenodd"
                                d="M16 3H8a4 4 0 0 0-4 4v10a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V7a4 4 0 0 0-4-4ZM8 5h8a2 2 0 0 1 2 2v2H6V7a2 2 0 0 1 2-2Zm2 10a1 1 0 1 0 0 2h4a1 1 0 1 0 0-2h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Jadwal Kuliah</span>
                    </a>
                </li>
                <!-- DATA MAHASISWA -->
                <li>
                    <a href="#"
                        class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M4 4c0-.6.4-1 1-1h14c.6 0 1 .4 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V4Zm12 4a1 1 0 1 0 0 2 1 1 0 1 0 0-2Zm-4 0a1 1 0 1 0 0 2 1 1 0 1 0 0-2Zm-4 0a1 1 0 1 0 0 2 1 1 0 1 0 0-2Zm8 5a1 1 0 1 0 0 2 1 1 0 1 0 0-2Zm-4 0a1 1 0 1 0 0 2 1 1 0 1 0 0-2Zm-4 0a1 1 0 1 0 0 2 1 1 0 1 0 0-2Z"
                                clip-rule="evenodd" />
                            <path d="M2 17a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5c0-.6-.4-1-1-1H3c-.6 0-1 .4-1 1v12Z" />
                        </svg>
                        <span class="ms-3">Data Mahasiswa</span>
                    </a>
                </li>
                <!-- DATA DOSEN -->
                <li>
                    <a href="#"
                        class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M12 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4h-4Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Data Dosen & Staf</span>
                    </a>
                </li>
                <!-- PENGATURAN -->
                <li class="pt-4 border-t border-gray-700/50 mt-4">
                    <a href="#"
                        class="sidebar-link flex items-center p-2 text-white hover:bg-kampus-utama rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd"
                                d="M11.9 2.1a1 1 0 0 1 .2.3l4 8a1 1 0 1 1-1.8.8L12 7.2l-3.3 4.8a1 1 0 1 1-1.8-.8l4-8a1 1 0 0 1 .2-.3Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M12 14a8 8 0 1 0 0 16 8 8 0 0 0 0-16ZM6 18a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm8.2-1.8a1 1 0 0 0 0-1.4 1 1 0 0 0-1.4 0l-3 3a1 1 0 0 0 0 1.4l3 3a1 1 0 0 0 1.4-1.4L11.4 18l2.8-2.8Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Pengaturan Sistem</span>
                    </a>
                </li>
                <!-- LOGOUT -->
                <li>
                    <a href="#"
                        class="sidebar-link flex items-center p-2 text-white hover:bg-red-600 rounded-lg">
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M12 2a1 1 0 0 0-1 1v9a1 1 0 1 0 2 0V3a1 1 0 0 0-1-1Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                d="M4.6 6.8a1 1 0 0 1 1.4 0 8.01 8.01 0 0 0 11.2 0 1 1 0 0 1 1.4-1.4 10.033 10.033 0 0 1-14 0 1 1 0 0 1 0 1.4Z"
                                clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M3 13.5a1 1 0 0 1 1-1h16a1 1 0 1 1 0 2H4a1 1 0 0 1-1-1Z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="ms-3">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- 3. MAIN CONTENT AREA -->
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 9 4-4-4-4" />
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">08:00 - 09:30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-kampus-utama">
                                        Struktur
                                        Data (A)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Dr. Andi Wijaya</td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">10:00 - 11:30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-kampus-utama">
                                        Kalkulus
                                        Lanjut (B)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Prof. Budi Santoso
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">13:00 - 14:30</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-kampus-utama">
                                        Pemrograman Web (C)</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Ibu Citra Dewi, M.Kom
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
                        <p class="text-sm text-gray-300 mb-4">Buat sesi presensi baru untuk mata kuliah yang mendesak.
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
                                    <span class="font-semibold">Budi S.</span> telah mengakhiri Presensi Matkul Logika.
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
                                    <span class="font-semibold">Ibu Citra D.</span> membuat Presensi Matkul Pemrograman
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




    <!-- Footer -->
    <footer class="lg:ml-64 p-4 bg-white border-t md:flex md:items-center md:justify-between md:p-6 shadow-t-lg">
        <span class="text-sm text-gray-500 sm:text-center">© 2025 Presensi Kampus. All Rights Reserved.
        </span>
        <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 sm:mt-0">
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Tentang</a>
            </li>
            <li>
                <a href="#" class="hover:underline me-4 md:me-6">Kebijakan Privasi</a>
            </li>
            <li>
                <a href="#" class="hover:underline">Kontak</a>
            </li>
        </ul>
    </footer>

    <script>
        // Simple utility to toggle mobile sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>

</body>

</html>
