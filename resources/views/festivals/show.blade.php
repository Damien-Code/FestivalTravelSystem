<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Festival - {{ $festival->festivalInfo->title }}
        </h2>
    </x-slot>
    <div class="mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <section class="py-8 bg-white md:py-16 dark:bg-gray-900 antialiased">
            <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0" id="{{$festival->id}}">
                @include('layouts.success')
                <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                    <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                        @if(isset($festival->festivalInfo->image))
                            <img class="w-full rounded-lg" src="{{$festival->festivalInfo->image}}" alt="image"
                                 class="w-24">
                        @endif
                    </div>

                    <div class="mt-6 sm:mt-8 lg:mt-0">
                        <div class="flex justify-between">
                            <h1
                                class="text-xl font-semibold text-gray-900 sm:text-xl dark:text-white"
                            >
                                {{$festival->location->city}} , {{$festival->location->country}}
                            </h1>
                            <a href="{{route('festivals.index')}}">
                                <x-primary-button>Back</x-primary-button>
                            </a>
                        </div>
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
                        <hr class="my-6 md:my-8border-gray-200 dark:border-gray-800"/>

                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            Adress: {{$festival->location->street}}
                        </p>

                        <p class="text-gray-500 dark:text-gray-400 pb-6">
                            {{$festival->festivalInfo->description}}
                        </p>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Departure location
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Departure time
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Sign ups
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($festival->routes as $route)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $route->location->city }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$route->departure_time)->format('H:i')}}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $route->signups() }}
                                        </td>
                                        <td class="px-6 py-4">
                                            &euro;{{ $route->price }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{route('festivals.order', [$festival, $route])}}">
                                                <x-primary-button>Order</x-primary-button>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4" colspan="3">New routes will be added soon!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
