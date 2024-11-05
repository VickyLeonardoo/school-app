<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Guru') }}: {{ $teacher->user->name }}
            </h2>
            <a href="{{ route('teacher.index') }}" class="bg-indigo-700 text-white px-4 py-2 rounded-full">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center">
                        <!-- Foto Guru -->
                        <div class="flex-shrink-0">
                            <img src="{{ $teacher->user->photo_url }}" alt="Foto {{ $teacher->user->name }}" class="h-24 w-24 rounded-full">
                        </div>
                        <div class="ml-6">
                            <h3 class="text-lg font-bold">{{ $teacher->user->name }}</h3>
                            <p class="text-gray-600">{{ $teacher->user->email }}</p>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-800">Informasi Tambahan:</h4>
                        <ul class="list-disc list-inside mt-2">
                            <li><strong>Nomor Telepon:</strong> {{ $teacher->user->phone }}</li>
                            <li><strong>Nomor Identitas:</strong> {{ $teacher->user->identity_no }}</li>
                            <li><strong>Terdaftar Sejak:</strong> {{ $teacher->created_at->format('d M Y') }}</li>
                        </ul>
                    </div>

                    <div class="mt-4">
                        <h4 class="font-semibold text-gray-800">Tentang:</h4>
                        <p class="mt-2">{{ $teacher->user->about ?? 'Belum ada informasi.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
