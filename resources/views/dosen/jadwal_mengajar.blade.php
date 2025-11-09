<x-mycomponents.layoutdosen>

    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2">
        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Jadwal Mengajar</h1>
        </nav>


        <div>

            {{-- data tabel --}}
            <div class="w-full overflow-x-auto">
                <table id="jadwalMengajarDosen" class="display min-w-full border border-gray-200">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="px-4 py-2 text-center">Hari</th>
                            <th class="px-4 py-2 text-center">Mata Kuliah</th>
                            <th class="px-4 py-2 text-center">Kelas</th>
                            <th class="px-4 py-2 text-center">Jam</th>
                            <th class="px-4 py-2 text-center">Semester</th>
                            <th class="px-4 py-2 text-center">Tahun Ajaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $jadwal)
                            <tr class="even:bg-gray-100">
                                <td class="px-4 py-2">{{ $jadwal->mataKuliah->nama_mk }}</td>
                                <td class="px-4 py-2">{{ $jadwal->kelas->nama_kelas }}</td>
                                <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                                <td class="px-4 py-2 text-center whitespace-nowrap">
                                    {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                    {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                                </td>
                                <td class="px-4 py-2">{{ $jadwal->semester }}</td>
                                <td class="px-4 py-2">{{ $jadwal->tahun_ajaran }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4 text-gray-500">
                                    Tidak ada jadwal.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- End data tabel -->


            <!-- Spacer for Footer -->
            <div class="h-16"></div>
        </div>

        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#jadwalMengajarDosen').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>

</x-mycomponents.layoutdosen>
