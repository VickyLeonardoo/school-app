<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Department') }}
            </h2>
            <a href="{{ route('teacher.index') }}"
                class="font-bold py-1 px-8 bg-indigo-700 text-white rounded-full flex items-center">
                <i class="fas fa-arrow-left mr-2"></i>
                Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="py-3 w-full bg-red-500 text-white font-bold mb-3">
                        <p class="ml-3">{{$error}}</p>
                    </div>
                @endforeach
            @endif
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @elseif (session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-200 dark:bg-gray-800 dark:text-red-400 relative"
                    role="alert">
                    <span class="font-medium">{{ session('error') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button"
                        class="absolute top-0 right-0 p-4 rounded-md text-red-600 hover:bg-red-300 hover:text-red-800"
                        aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <form method="POST" action="{{ route('teacher.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- name, email, password, phone, identity_no --}}
                    <div class="mt-4">
                        <x-input-label for="identity_no" :value="__('Nomor Induk Pegawai (NIP)')" />
                        <x-text-input id="identity_no" class="block mt-1 w-full" type="text" name="identity_no"
                            :value="old('identity_no')" required autofocus autocomplete="identity_no" />
                        <x-input-error :messages="$errors->get('identity_no')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="name" :value="__('Nama Lengkap')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="phone" :value="__('Nomor Ponsel')" />
                        <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone"
                            :value="old('phone')" required autofocus autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus autocomplete="email" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="mt-4">
                        <x-input-label for="photo" :value="__('Foto')" />
                        
                        <div class="relative">
                            <input type="file" id="photo" name="photo" class="hidden" required autofocus autocomplete="photo">
                            <label for="photo" class="flex items-center">
                                <span class="bg-white px-4 py-2 border rounded-l cursor-pointer hover:bg-gray-50">
                                    Pilih File
                                </span>
                                <span class="file-name px-4 py-2 border-t border-b border-r rounded-r flex-grow">
                                    Tidak ada file yang dipilih
                                </span>
                            </label>
                        </div>
                    
                        <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">

                        <button type="submit" class="font-bold py-4 px-6 bg-indigo-700 text-white rounded-full">
                            Simpan
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <style>
        .hidden {
            display: none;
        }
    </style>
        
    <script>
        document.getElementById('photo').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Tidak ada file yang dipilih';
            e.target.parentElement.querySelector('.file-name').textContent = fileName;
        });
    </script>
</x-app-layout>
