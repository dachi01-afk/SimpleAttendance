<x-mycomponents.layoutmahasiswa>

    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2">
        <!-- Breadcrumb & Title -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Data Mata Kuliah</h1>
        </nav>

        <div>
            {{-- Data Tabel --}}
            <div class="w-full overflow-x-auto">
                <table id="dataMatakuliahMahasiswa" class="display min-w-full border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-center">Hari</th>
                            <th class="px-4 py-2 text-center">Mata Kuliah</th>
                            <th class="px-4 py-2 text-center">Kelas</th>
                            <th class="px-4 py-2 text-center">Dosen Pengampu</th>
                            <th class="px-4 py-2 text-center">Jam</th>
                            <th class="px-4 py-2 text-center">Semester</th>
                            <th class="px-4 py-2 text-center">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                            <tr class="even:bg-gray-100">
                                <td class="px-4 py-2 text-center">{{ $jadwal->nama_hari }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->mataKuliah->nama_mk ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->kelas->nama_kelas ?? '-' }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->dosen->nama_dosen ?? '-' }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">
                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                    {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                </td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->semester }}</td>
                                <td class="px-4 py-2 text-center">{{ $jadwal->tahun_ajaran }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    Tidak ada data mata kuliah yang terdaftar.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- End Data Tabel -->

            <div class="h-16"></div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#dataMatakuliahMahasiswa').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>

</x-mycomponents.layoutmahasiswa>
