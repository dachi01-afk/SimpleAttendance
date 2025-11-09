<x-mycomponents.layoutadmin>
    {{-- <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-20"> --}}
    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2">

        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Laporan Presensi Dosen</h1>
        </nav>

        {{-- data tabel --}}
        <div class="container">
            <table id="dosenTable" class="display min-w-full border border-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Nama Dosen</th>
                        <th class="px-4 py-2 text-center">Tanggal</th>
                        <th class="px-4 py-2 text-center">Jam</th>
                        <th class="px-4 py-2 text-center">Status</th>
                        <th class="px-4 py-2 text-center">Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensiDosen as $item)
                        <tr class="even:bg-gray-100">
                            <td class="px-4 py-2">{{ $item->dosen->nama_dosen }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal }}</td>
                            <td class="px-4 py-2">{{ date('H:i', strtotime($item->jam_masuk)) }} -
                                {{ date('H:i', strtotime($item->jam_pulang)) }}</td>
                            <td class="px-4 py-2">{{ $item->status }}</td>
                            <td class="px-4 py-2">{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#dosenTable').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>
</x-mycomponents.layoutadmin>
