<x-mycomponents.layoutadmin>
    {{-- <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-20"> --}}
    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2e">

        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Laporan Presensi Mahasiswa</h1>
        </nav>

        {{-- data tabel --}}
        <div class="container">
            <table id="mahasiswaTable" class="display min-w-full border border-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">NIM</th>
                        <th class="px-4 py-2 text-center">Nama Mahasiswa</th>
                        <th class="px-4 py-2 text-center">Kelas</th>
                        <th class="px-4 py-2 text-center">Matakuliah</th>
                        <th class="px-4 py-2 text-center">Dosen</th>
                        <th class="px-4 py-2 text-center">Tanggal</th>
                        <th class="px-4 py-2 text-center">Jam Presensi</th>
                        <th class="px-4 py-2 text-center">Keterangan</th>
                        <th class="px-4 py-2 text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($presensiMhs as $item)
                        <tr class="even:bg-gray-100">
                            <td class="px-4 py-2">{{ $item->mahasiswa->nim }}</td>
                            <td class="px-4 py-2">{{ $item->mahasiswa->nama_mahasiswa }}</td>
                            <td class="px-4 py-2">{{ $item->mahasiswa->kelas->nama_kelas }}</td>
                            <td class="px-4 py-2">{{ $item->jadwalKuliah->MataKuliah->nama_mk }}</td>
                            <td class="px-4 py-2">{{ $item->dosen->nama_dosen }}</td>
                            <td class="px-4 py-2">{{ $item->tanggal }}</td>
                            <td class="px-4 py-2">{{ date('H:i', strtotime($item->waktu_presensi)) }}</td>
                            <td class="px-4 py-2">{{ $item->keterangan ?? '-' }}</td>
                            <td class="px-4 py-2">{{ $item->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#mahasiswaTable').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>
</x-mycomponents.layoutadmin>
