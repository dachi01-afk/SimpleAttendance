<x-mycomponents.layoutadmin>
    {{-- <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-20"> --}}
    <main id="main-content" class="p-4 lg:ml-64 mt-16 lg:mt-2" x-data="{
        openAdd: {{ $errors->any() && session('form') === 'add' ? 'true' : 'false' }},
        openEdit: {{ $errors->any() && session('form') === 'edit' ? 'true' : 'false' }},
        openDelete: false,
        deleteUrl: '',
        editData: {}
    }">

        <!-- Breadcrumb & Greeting -->
        <nav class="flex mb-2" aria-label="Breadcrumb">
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Data Jadwal Kuliah</h1>
        </nav>

        <!-- Tombol Tambah -->
        <button @click="openAdd=true" class="mb-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Tambah Jadwal Kuliah
        </button>
        @if (session('success'))
            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition
                class="fixed top-5 right-5 z-50 bg-green-500 text-white px-4 py-3 rounded-lg shadow-lg flex items-center space-x-2"
                role="alert">
                <!-- Ikon centang -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>

                <!-- Pesan -->
                <span>{{ session('success') }}</span>

                <!-- Tombol tutup manual -->
                <button @click="show = false" class="ml-2 text-white font-bold">×</button>
            </div>
        @endif


        {{-- data tabel --}}
        <div class="container">
            <table id="jadwalKuliahTable" class="display min-w-full border border-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">Dosen</th>
                        <th class="px-4 py-2 text-center">Mata Kuliah</th>
                        <th class="px-4 py-2 text-center">Kelas</th>
                        <th class="px-4 py-2 text-center">Hari</th>
                        <th class="px-4 py-2 text-center">Jam</th>
                        <th class="px-4 py-2 text-center">Semester</th>
                        <th class="px-4 py-2 text-center">Tahun Ajaran</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr class="even:bg-gray-100">
                            <td class="px-4 py-2">{{ $jadwal->dosen->nama_dosen }}</td>
                            <td class="px-4 py-2">{{ $jadwal->mataKuliah->nama_mk }}</td>
                            <td class="px-4 py-2">{{ $jadwal->kelas->nama_kelas }}</td>
                            <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                            <td class="px-4 py-2 text-center whitespace-nowrap">
                                {{ date('H:i', strtotime($jadwal->jam_mulai)) }} -
                                {{ date('H:i', strtotime($jadwal->jam_selesai)) }}
                            </td>
                            <td class="px-4 py-2">{{ $jadwal->semester }}</td>
                            <td class="px-4 py-2">{{ $jadwal->tahun_ajaran }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <!-- Tombol Edit -->
                                <button
                                    @click="openEdit=true; editData={
                                        id:'{{ $jadwal->id }}',
                                        dosen_id:'{{ $jadwal->dosen_id }}',
                                        mata_kuliah_id:'{{ $jadwal->mata_kuliah_id }}',
                                        kelas_id:'{{ $jadwal->kelas_id }}',
                                        hari:'{{ $jadwal->hari }}',
                                        jam_mulai:'{{ substr($jadwal->jam_mulai, 0, 5) }}',
                                        jam_selesai:'{{ substr($jadwal->jam_selesai, 0, 5) }}',
                                        semester:'{{ $jadwal->semester }}',
                                        tahun_ajaran:'{{ $jadwal->tahun_ajaran }}'
                                    }"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Edit
                                </button>

                                <!-- Tombol Delete -->
                                <button type="button"
                                    @click="openDelete=true; deleteUrl='{{ route('jadwal_kuliahs.destroy', $jadwal->id) }}'"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- End data tabel -->

        <!-- Modal Tambah -->
        <div x-show="openAdd" @keydown.escape.window="openAdd=false"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="openAdd=false; $refs.addForm.reset();"
                class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Tambah Jadwal Kuliah</h2>
                <form x-ref="addForm" action="{{ route('jadwal_kuliahs.store') }}" method="POST">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="dosen_id" class="block">Dosen</label>
                            <select id="dosen_id" name="dosen_id" class="w-full border rounded p-2" required
                                value="{{ old('dosen_id') }}">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosens as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mata_kuliah_id" class="block">Matakuliah</label>
                            <select id="mata_kuliah_id" name="mata_kuliah_id" class="w-full border rounded p-2" required
                                value="{{ old('mata_kuliah_id') }}">
                                <option value="">-- Pilih Matakuliah --</option>
                                @foreach ($matakuliahs as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" class="block">Kelas</label>
                            <select id="kelas_id" name="kelas_id" class="w-full border rounded p-2" required
                                value="{{ old('kelas_id') }}">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hari" class="block">Hari</label>
                            <select id="hari" name="hari" class="w-full border rounded p-2" required
                                value="{{ old('hari') }}">
                                <option value="">-- Pilih Hari --</option>
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Mulai -->
                        <div class="mb-3">
                            <label class="block">Jam Mulai</label>
                            <input type="time" name="jam_mulai" class="w-full border rounded p-2"
                                value="{{ old('jam_mulai') }}"required>
                            @error('jam_mulai')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Selesai -->
                        <div class="mb-3">
                            <label class="block">Jam Selesai</label>
                            <input type="time" name="jam_selesai" class="w-full border rounded p-2"
                                value="{{ old('jam_selesai') }}"required>
                            @error('jam_selesai')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="mb-3">
                            <label class="block">Semester</label>
                            <input type="text" name="semester" class="w-full border rounded p-2"
                                value="{{ old('semester') }}"required>
                            @error('semester')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Ajaran -->
                        <div class="mb-3">
                            <label class="block">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="w-full border rounded p-2"
                                value="{{ old('tahun_ajaran') }}"required>
                            @error('tahun_ajaran')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openAdd=false; $refs.addForm.reset();"
                            class="px-4 py-2 bg-gray-400 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- Modal Edit -->
        <div x-show="openEdit" @keydown.escape.window="openEdit=false"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="openEdit=false" class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Edit Jadwal Kuliah</h2>
                <form :action="'/admin/jadwal_kuliahs/' + editData.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-3">
                            <label for="dosen_id" class="block">Dosen</label>
                            <select id="dosen_id" name="dosen_id" class="w-full border rounded p-2" required
                                :value="editData.dosen_id">
                                <option :value="editData.nama_dosen">-- Pilih Dosen --</option>
                                @foreach ($dosens as $item)
                                    <option value="{{ $item->id }}"
                                        :selected="editData.dosen_id == {{ $item->id }}">
                                        {{ $item->nama_dosen }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mata_kuliah_id" class="block">Matakuliah</label>
                            <select id="mata_kuliah_id" name="mata_kuliah_id" class="w-full border rounded p-2"
                                required :value="editData.mata_kuliah_id">
                                <option>-- Pilih Matakuliah --</option>
                                @foreach ($matakuliahs as $item)
                                    <option value="{{ $item->id }}"
                                        :selected="editData.mata_kuliah_id == {{ $item->id }}">
                                        {{ $item->nama_mk }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" class="block">Kelas</label>
                            <select id="kelas_id" name="kelas_id" class="w-full border rounded p-2" required
                                :value="editData.kelas_id">
                                <option>-- Pilih Kelas --</option>
                                @foreach ($kelas as $item)
                                    <option value="{{ $item->id }}"
                                        :selected="editData.kelas_id == {{ $item->id }}">
                                        {{ $item->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="hari" class="block">Hari</label>
                            <select id="hari" name="hari" class="w-full border rounded p-2" required
                                :value="editData.hari">
                                <option value="">-- Pilih Hari --</option>
                                @foreach (['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'] as $hari)
                                    <option value="{{ $hari }}">{{ $hari }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Mulai -->
                        <div class="mb-3">
                            <label class="block">Jam Mulai</label>
                            <input type="time" x-model="editData.jam_mulai" name="jam_mulai"
                                class="w-full border rounded p-2" :value="editData.jam_mulai" required>
                            @error('jam_mulai')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Selesai -->
                        <div class="mb-3">
                            <label class="block">Jam Selesai</label>
                            <input type="time" x-model="editData.jam_selesai" name="jam_selesai"
                                class="w-full border rounded p-2" :value="editData.jam_selesai" required>
                            @error('jam_selesai')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="mb-3">
                            <label class="block">Semester</label>
                            <input type="text" name="semester" class="w-full border rounded p-2"
                                :value="editData.semester" required>
                            @error('semester')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Ajaran -->
                        <div class="mb-3">
                            <label class="block">Tahun Ajaran</label>
                            <input type="text" name="tahun_ajaran" class="w-full border rounded p-2"
                                :value="editData.tahun_ajaran"required>
                            @error('tahun_ajaran')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <div class="flex justify-end gap-2">
                        <button type="button" @click="openEdit=false"
                            class="px-4 py-2 bg-gray-400 rounded">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal Konfirmasi Delete -->
        <div x-show="openDelete" x-cloak
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50" x-transition>
            <div @click.away="openDelete=false" class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
                <h2 class="text-lg font-semibold mb-4 text-red-600">Konfirmasi Hapus</h2>
                <p class="mb-6">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak bisa dibatalkan.
                </p>
                <form :action="deleteUrl" method="POST" class="flex justify-end gap-2">
                    @csrf
                    @method('DELETE')
                    <button type="button" @click="openDelete=false"
                        class="px-4 py-2 bg-gray-400 rounded">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded">Ya, Hapus</button>
                </form>
            </div>
        </div>


        @push('scripts')
            <script>
                $(document).ready(function() {
                    $('#jadwalKuliahTable').DataTable({
                        responsive: true,
                        autoWidth: false,
                        scrollX: true
                    });
                });
            </script>
        @endpush
    </main>
</x-mycomponents.layoutadmin>
