<x-mycomponents.layoutdosen>

    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2">
        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Laporan Presensi</h1>
        </nav>


        <div>

            <!-- Filter -->
            <form method="GET" class="bg-white shadow rounded p-4 mb-4 flex flex-wrap gap-3 items-end">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="dari" value="{{ request('dari') }}"
                        class="border-gray-300 rounded p-2">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="sampai" value="{{ request('sampai') }}"
                        class="border-gray-300 rounded p-2">
                </div>

                <div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tampilkan</button>
                </div>
            </form>

            <!-- Data Table -->
            <div class="overflow-x-auto bg-white rounded shadow">
                <table class="min-w-full text-sm border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-center">No</th>
                            <th class="px-4 py-2 text-center">Tanggal</th>
                            <th class="px-4 py-2 text-center">Jam Masuk</th>
                            <th class="px-4 py-2 text-center">Jam Pulang</th>
                            <th class="px-4 py-2 text-center">Status</th>
                            <th class="px-4 py-2 text-center">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($presensis as $i => $p)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-center">{{ $i + 1 }}</td>
                                <td class="px-4 py-2 text-center">
                                    {{ \Carbon\Carbon::parse($p->tanggal)->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 text-center">
                                    {{ $p->jam_masuk ? \Carbon\Carbon::parse($p->jam_masuk)->format('H:i') : '-' }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    {{ $p->jam_pulang ? \Carbon\Carbon::parse($p->jam_pulang)->format('H:i') : '-' }}
                                </td>
                                <td
                                    class="px-4 py-2 text-center font-semibold
                                @if ($p->status == 'hadir') text-green-600
                                @elseif($p->status == 'izin') text-yellow-600
                                @elseif($p->status == 'sakit') text-blue-600
                                @else text-red-600 @endif">
                                    {{ ucfirst($p->status) }}
                                </td>
                                <td class="px-4 py-2 text-center">{{ $p->keterangan ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-500 py-4">Tidak ada data presensi
                                    ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>


            <!-- Spacer for Footer -->
            <div class="h-16"></div>
        </div>

    </main>

</x-mycomponents.layoutdosen>
