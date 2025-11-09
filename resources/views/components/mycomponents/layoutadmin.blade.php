<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presensi</title>
    <link href='{{ asset('storage/assets/logo.png') }}' rel='shortcut icon'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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

    {{-- flowbite --}}
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />

</head>

<body class="bg-gray-50 antialiased flex flex-col min-h-screen">

    <!-- 1. NAVIGATION BAR (Header) -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-white border-b border-gray-200 shadow-sm">
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

                    <!-- Logo di sudut kiri atas -->
                    <a href="#" class="flex items-center space-x-3">
                        <!-- Lingkaran berisi logo -->
                        <div
                            class="w-10 h-10 sm:w-12 sm:h-12 bg-kampus-utama rounded-full flex items-center justify-center">
                            <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo Royal Klinik"
                                class="h-6 w-6 sm:h-8 sm:w-8 object-contain" />
                        </div>

                        <!-- Teks Judul -->
                        <span class="text-lg sm:text-xl font-semibold text-gray-900 tracking-wide">
                            Presensi Kampus
                        </span>
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
                                {{-- <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link> --}}

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
    <div class="flex-grow pt-[72px]">
        <div id="overlay" onclick="toggleSidebar()" class="fixed inset-0 z-30 bg-gray-900/50 hidden lg:hidden"></div>

        <div>
            {{-- Menu --}}
            <aside id="sidebar"
                class="fixed top-[72px] left-0 z-40 w-64 h-[calc(100%-72px)] pt-8 bg-kampus-gelap text-white overflow-y-auto transform -translate-x-full transition-transform lg:translate-x-0"
                aria-label="Sidebar">
                @include('admin.sideadmin')
            </aside>

            <!-- MAIN CONTENT AREA -->
            {{ $slot }}
        </div>
    </div>


    <!-- Footer -->
    <footer
        class=" mt-auto lg:ml-64 p-4 bg-white border-t md:flex md:items-center md:justify-between md:p-6 shadow-t-lg">
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

    {{-- flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    @stack('scripts')
</body>

</html>
