<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-bold mb-2">Selamat datang, {{ Auth::user()->name }}!</h3>
                <p>Anda masuk sebagai <strong>User/Staf</strong>. Di sini Anda dapat melihat informasi umum atau mengajukan laporan kerusakan aset POLNEP.</p>
            </div>
        </div>
    </div>
</x-app-layout>