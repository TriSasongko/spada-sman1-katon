<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard Guru
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900">Selamat Datang, Guru!</h3>

                    <p class="mt-4">Anda berhasil login sebagai Guru. Ini adalah dashboard kustom Anda (Non-Filament).</p>

                    <div class="mt-6 border-t border-gray-200 pt-4">
                        <dl class="divide-y divide-gray-100">
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Nama Lengkap</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $guru->nama ?? 'N/A' }}</dd>
                            </div>
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">NIP</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $guru->nip ?? 'N/A' }}</dd>
                            </div>
                            <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                                <dt class="text-sm font-medium leading-6 text-gray-900">Email Akun</dt>
                                <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $guru->user->email ?? 'N/A' }}</dd>
                            </div>
                        </dl>
                    </div>

                    <p class="mt-6 text-sm text-gray-500">Sekarang Anda dapat mulai menambahkan fungsionalitas khusus Guru di sini.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
