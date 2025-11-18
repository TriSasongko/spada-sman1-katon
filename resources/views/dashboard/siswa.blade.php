<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Siswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Selamat Datang, Siswa!</h3>

                    <p class="mt-4">Anda berhasil login sebagai Siswa. Ini adalah dashboard kustom Anda.</p>

                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Nama Lengkap</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $siswa->nama ?? 'N/A' }}</dd>
                            </div>
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">NIS</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $siswa->nis ?? 'N/A' }}</dd>
                            </div>
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Kelas</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $siswa->kelas->nama ?? 'N/A' }}</dd>
                            </div>
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Email Akun</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $siswa->user->email ?? 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>
                    <p class="mt-6 text-sm text-gray-500">Di sini Anda dapat menampilkan jadwal, nilai, dan informasi Siswa lainnya.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
