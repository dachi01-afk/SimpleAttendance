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
            <h1 class="text-2xl font-semibold text-gray-900 mb-2">Data Dosen</h1>
        </nav>

        <!-- Tombol Tambah -->
        <button @click="openAdd=true" class="mb-3 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
            + Tambah Dosen
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
            <table id="dosenTable" class="display min-w-full border border-gray-200">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="px-4 py-2 text-center">NIP</th>
                        <th class="px-4 py-2 text-center">Nama Dosen</th>
                        <th class="px-4 py-2 text-center">Prodi</th>
                        <th class="px-4 py-2 text-center">Email</th>
                        <th class="px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosens as $index => $dosen)
                        <tr class="even:bg-gray-100">
                            <td class="px-4 py-2">{{ $dosen->nip }}</td>
                            <td class="px-4 py-2">{{ $dosen->nama_dosen }}</td>
                            <td class="px-4 py-2">{{ $dosen->prodi }}</td>
                            <td class="px-4 py-2">{{ $dosen->user->email }}</td>
                            <td class="px-4 py-2 flex gap-2">
                                <!-- Tombol Edit -->
                                <button
                                    @click="openEdit=true; 
                                    editData={
                                id:'{{ $dosen->id }}',
                                nip:'{{ $dosen->nip }}',
                                nama_dosen:'{{ $dosen->nama_dosen }}',
                                prodi:'{{ $dosen->prodi }}',
                                email:'{{ $dosen->user->email }}'
                            }"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded">
                                    Edit
                                </button>

                                <!-- Tombol Delete -->
                                <button type="button"
                                    @click="openDelete=true; deleteUrl='{{ route('dosens.destroy', $dosen->id) }}'"
                                    class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Modal Tambah -->
        <div x-show="openAdd" @keydown.escape.window="openAdd=false"
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div @click.away="openAdd=false; $refs.addForm.reset();"
                class="bg-white rounded-lg shadow-lg w-full max-w-lg p-6">
                <h2 class="text-xl font-semibold mb-4">Tambah Dosen</h2>
                <form x-ref="addForm" action="{{ route('dosens.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="block">NIP</label>
                        <input type="text" name="nip" class="w-full border rounded p-2"
                            value="{{ old('nip') }}"required>
                        @error('nip')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="w-full border rounded p-2"
                            value="{{ old('nama_dosen') }}"required>
                        @error('nama_dosen')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Prodi</label>
                        <input type="text" name="prodi" class="w-full border rounded p-2"
                            value="{{ old('prodi') }}"required>
                        @error('prodi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2"
                            value="{{ old('email') }}"required>
                        @error('email')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2" required>
                        @error('password')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
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
                <h2 class="text-xl font-semibold mb-4">Edit Dosen</h2>
                <form :action="'/admin/dosens/' + editData.id" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="block">NIP</label>
                        <input type="text" name="nip" class="w-full border rounded p-2" :value="editData.nip"
                            required>
                        @error('nip')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Nama Dosen</label>
                        <input type="text" name="nama_dosen" class="w-full border rounded p-2"
                            :value="editData.nama_dosen" required>
                        @error('nama_dosen')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Prodi</label>
                        <input type="text" name="prodi" class="w-full border rounded p-2"
                            :value="editData.prodi" required>
                        @error('prodi')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2"
                            :value="editData.email"required>
                        @error('email')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="block">Password (opsional)</label>
                        <input type="password" name="password" class="w-full border rounded p-2">
                        @error('password')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
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
                <p class="mb-6">Apakah Anda yakin ingin menghapus data dosen ini? Tindakan ini tidak bisa dibatalkan.
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
