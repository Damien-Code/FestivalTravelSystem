<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="md:flex justify-between sm:flex-none">
                <p class="text-white text-3xl font-bold pb-6 md:pb-0">Festivals</p>
                <div>
                    {{-- Buttons to create or pair festivals --}}
                    <a href="{{route('admin.festivals.create')}}">
                        <x-primary-button>
                            Create new festival
                        </x-primary-button>
                    </a>
                    <a href="{{route('admin.festivals.pair')}}">
                        <x-primary-button>
                            Pair a festival
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    {{-- Delete flash message --}}
    @include('layouts.delete')

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            {{-- Search bar --}}
            <div class="max-w-xl pb-6">
                <form class="max-w-md mx-auto" action="{{route('admin.festivals.index')}}" method="GET">
                    <label for="default-search"
                           class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                            </svg>
                        </div>
                        <input value="{{request('search', '')}}" name="search" type="text" id="default-search"
                               class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="Search festivals..."/>
                        <x-primary-button class="absolute end-2.5 bottom-2.5">Search</x-primary-button>
                    </div>
                </form>
            </div>
            {{-- Table for every festival --}}
            <div class="flex justify-center">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Festival name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        {{-- Table row for all the festivals --}}
                        @forelse($festivals as $festival)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$festival->festivalInfo->title}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$festival->festivalInfo->description}}
                                </td>
                                <td class="px-6 py-4">
                                    {{-- Date had to be formatted with carbon --}}
                                    {{\Carbon\Carbon::parse($festival->date)->format('Y-m-d')}}
                                </td>
                                <td class="px-6 py-4">
                                    Amsterdam
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{route('admin.festivals.edit', $festival->id)}}">
                                        <x-primary-button>
                                            Edit
                                        </x-primary-button>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    {{-- Form to delete festival --}}
                                    <form method="post"
                                          action="{{route('admin.festivals.destroy', $festival->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <x-danger-button>Delete</x-danger-button>
                                    </form>
                                </td>
                            </tr>
                            {{-- If no results are found --}}
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 whitespace-nowrap">
                                <td class="px-6 py-4">No results found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    {{-- Pagination link --}}
                    <div class="w-full flex justify-center p-8">
                        {{$festivals->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
