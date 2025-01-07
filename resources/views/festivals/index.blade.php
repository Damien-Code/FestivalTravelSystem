<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Festivals') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <form class="max-w-md mx-auto" action="{{route('festivals.index')}}" method="GET">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>

                <input  value="{{request('search', '')}}" name="search" type="text" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search festivals..." required />
                <x-primary-button class="absolute end-2.5 bottom-2.5" >Search</x-primary-button>
            </div>
        </form>
        @forelse($festivals as $festival)
            <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
                <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0" id="{{$festival->id}}">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                        <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                            @if(isset($festival->festivalInfo->image))
                                <img class="w-full" src="{{$festival->festivalInfo->image}}" alt="image" class="w-24">
                            @endif
                        </div>

                        <div class="mt-6 sm:mt-8 lg:mt-0">
                            <h1
                                class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
                            >
                                {{$festival->festivalInfo->title}}
                            </h1>
                            <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                                <p
                                    class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white"
                                >
                                    $1,249.99
                                </p>

                                <div class="flex items-center gap-2 mt-2 sm:mt-0">

                                    <p
                                        class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400"
                                    >
                                        {{\Carbon\Carbon::parse($festival->date)->format('j M Y')}}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                                <a href="{{ route('festivals.show', $festival->id) }}">
                                    <x-primary-button>Order</x-primary-button>
                                </a>

                            </div>

                            <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800"/>

                            <p class="mb-6 text-gray-500 dark:text-gray-400">
                                {{$festival->location->city}} , {{$festival->location->country}}
                            </p>

                            <p class="text-gray-500 dark:text-gray-400">
                                {{$festival->festivalInfo->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        @empty
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg col-span-3">
                <div class="max-w-xl m-auto text-center">
                    <p>No results found.</p>
                </div>
            </div>
        @endforelse
        {{--        Pagination for festivals--}}
        <div class="w-full flex justify-center p-8">
            {{$festivals->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
