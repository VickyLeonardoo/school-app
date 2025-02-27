<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Teacher List') }}
            </h2>
        </div>

    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-200 dark:bg-gray-800 dark:text-green-400 relative" role="alert">
                    <span class="font-medium">{{ session('success') }}!</span>
                    <!-- Tombol silang dengan SVG -->
                    <button type="button" class="absolute top-0 right-0 p-4 rounded-md text-green-600 hover:bg-green-300 hover:text-green-800" aria-label="Close" onclick="this.parentElement.style.display='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-10 flex flex-col gap-y-5">
                <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                    <a href="{{ route('teacher.create') }}" class="bg-indigo-600 hover:bg-indigo-300 text-white font-bold py-2 px-4 rounded-lg transition duration-300 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                        </svg>
                        Tambah Data Guru
                    </a>
                    <form method="GET" action="{{ route('teacher.index') }}" class="flex w-full md:w-auto">
                        <input type="text" name="search" placeholder="Cari data guru"
                            class="rounded-l-full w-full md:w-64 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            value="{{ request('search') }}">
                        <button type="submit"
                            class="bg-indigo-600 text-white px-4 py-2 rounded-r-full hover:bg-indigo-700 transition duration-300 ml-auto">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
                <table class="border-collapse table-auto w-full whitespace-no-wrap bg-white table-striped relative">
                    <thead>
                        <tr class="text-left">
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                NIP</th>
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Nama</th>
                            <th
                                class="bg-indigo-50 sticky top-0 border-b border-gray-200 px-6 py-3 text-indigo-600 font-bold tracking-wider uppercase text-xs">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody id="users-table-body">
                        @forelse ($teachers as $teacher)
                            <tr>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $teacher->user->identity_no }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">{{ $teacher->user->name }}</td>
                                <td class="border-b border-gray-200 px-6 py-4">
                                    <a href="{{ route('teacher.show', $teacher) }}" class="font-bold py-2 px-4 bg-indigo-700 hover:bg-indigo-400 text-white rounded-lg">View</a>
                                </td>
                            <tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center border-b border-gray-200 px-6 py-4">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-4">
                    {{ $teachers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
