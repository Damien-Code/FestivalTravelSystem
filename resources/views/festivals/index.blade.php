<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Festivals') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        @include('layouts.error')
        {{-- Search bar --}}
        <x-search-bar :action="route('festivals.index')"></x-search-bar>
        {{-- All the festivals --}}
        @forelse($festivals as $festival)
            <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
                <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0" id="{{$festival->id}}">
                    <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                        <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                            @if(isset($festival->festivalInfo->image))
                                <img class="w-full rounded-lg" src="{{$festival->festivalInfo->image}}" alt="image"
                                     class="w-24">
                            @endif
                        </div>

                        <div class="mt-6 sm:mt-8 lg:mt-0">
                            <h1
                                class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white"
                            >
                                {{$festival->location->city}} , {{$festival->location->country}}
                            </h1>
                            <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                                <p
                                    class="text-3xl font-extrabold text-gray-900 sm:text-4xl dark:text-white"
                                >
                                    {{$festival->festivalInfo->title}}
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
                                Address: {{$festival->location->street}}
                            </p>

                            <p class="text-gray-500 dark:text-gray-400">
                                {{$festival->festivalInfo->description}}
                            </p>
                        </div>
                    </div>
                </div>
            </section>
{{-- If search has no results --}}
        @empty
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg col-span-3">
                <div class="max-w-xl m-auto text-center">
                    <p>No results found.</p>
                </div>
            </div>
        @endforelse
        {{-- Pagination for festivals --}}
        <div class="w-full flex justify-center p-8">
            {{$festivals->withQueryString()->links()}}
        </div>
    </div>
</x-app-layout>
