<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Presensi</title>
    <link href='{{ asset('storage/assets/logo.png') }}' rel='shortcut icon'>
    <!-- Asumsi Anda sudah menjalankan npm run dev atau npm run build -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Gaya kustom untuk memastikan tampilan modern dan responsif */
        .clinic-bg {
            /* Warna latar belakang cerah dan menenangkan (Sky Blue Light) */
            /* background-color: #f0f9ff; */
            background-color: #f8fafc;
            /* Light Sky Blue */
        }

        .clinic-card {
            /* Bayangan lembut untuk kesan profesional, disesuaikan agar lebih mirip dashboard */
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08), 0 0 4px rgba(0, 0, 0, 0.04);
            transition: transform 0.3s ease;
        }

        .clinic-card:hover {
            transform: translateY(-2px);
        }

        /* PERUBAHAN: Gaya untuk input saat fokus (agar lebih selaras dengan aksen biru dashboard) */
        .input-focus:focus {
            border-color: #0ea5e9 !important;
            /* Sky-600 */
            box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.3) !important;
            /* Ring fokus biru muda */
        }
    </style>
</head>

<body class="font-sans antialiased clinic-bg min-h-screen flex items-center justify-center p-4 sm:p-6">
    <!-- Kontainer Login -->
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white clinic-card overflow-hidden rounded-xl">

        <!-- Area Logo (Siap ditambahkan logo klinik Anda) -->
        <div class="flex flex-col items-center justify-center mb-6">
            <!-- LOGO KLINIK DITAMBAHKAN DI SINI -->
            <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo Presensi"
                class="block mx-auto h-20 w-auto max-w-[100px] sm:max-w-[120px] md:max-w-[150px] mb-4" />

            <p class="text-sm font-medium text-sky-600 mb-1 tracking-wider">SISTEM PRESENSI KAMPUS</p>
            <h1 class="text-2xl font-bold text-gray-800">MASUK</h1>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-sky-600 bg-sky-100 p-3 rounded-lg">
                {{ session('status') }}
            </div>
        @endif

        <!-- Form Login -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700 mb-1">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                    autocomplete="username"
                    class="w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm p-3"
                    placeholder="">
                @error('email')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block font-medium text-sm text-gray-700 mb-1">Password</label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="w-full border-gray-300 focus:border-sky-500 focus:ring-sky-500 rounded-lg shadow-sm p-3"
                    placeholder="">
                @error('password')
                    <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me & Actions -->
            <div class="flex items-center justify-between mt-4">

                <!-- Remember Me -->
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-sky-600 shadow-sm focus:ring-sky-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                </label>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-sky-600 hover:text-sky-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500"
                        href="{{ route('password.request') }}">
                        Lupa Password?
                    </a>
                @endif
            </div>

            <!-- Button Login -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-sky-600 hover:bg-sky-700 text-white font-bold py-3 px-4 rounded-lg transition duration-150 ease-in-out shadow-lg shadow-sky-200 focus:outline-none focus:ring-4 focus:ring-sky-500 focus:ring-opacity-50">
                    Masuk
                </button>
            </div>

        </form>
    </div>
</body>

</html>
