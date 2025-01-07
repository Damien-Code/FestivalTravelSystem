<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="md:flex justify-between sm:flex-none">
                <p class="text-white text-3xl font-bold pb-6 md:pb-0">Festivals</p>
                <div>
                    <a href="{{route('admin.routes.create')}}">
                        <x-primary-button>
                            Create new route
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl pb-6">
                <form action="{{route('admin.routes.index')}}" method="GET">
                    <input value="{{request('search', '')}}" name="search" placeholder="..." type="text"
                           class="text-black rounded-lg w-3/5 md:w-3/4">
                    <x-primary-button>Search</x-primary-button>
                </form>
            </div>
            <div class="flex justify-center">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Festival name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Festival date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                price
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
                        @forelse($routes as $route)
{{--                            {{ $route }}--}}
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$route->festival->festivalInfo->title}}
                                </th>
                                <th class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($route->festival->date)->format('Y-m-d')  }}
                                </th>
                                <td class="px-6 py-4">
                                    {{$route->location->city}}
                                </td>
                                <td class="px-6 py-4">
                                    {{\Carbon\Carbon::parse($route->departure_time)->format('Y-m-d / H:i')}}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $route->price }}
                                </td>
                            </tr>
                        @empty
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 whitespace-nowrap">
                                <td class="px-6 py-4">No results found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="w-full flex justify-center p-8">
                        {{$routes->withQueryString()->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
