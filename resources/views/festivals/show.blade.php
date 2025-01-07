<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Festival - {{ $festival->festivalInfo->title }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <table class="text-2xl text-white">
                    <thead>
                    <tr>
                        <th>Vertrek Locatie</th>
                        <th>Vertrektijden</th>
                        <th>Aanmeldingen</th>
                        <th>Prijs</th>
                        <th>Bestel</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($festival->routes as $route)
                        <tr>
                            <td>{{ $route->location->city }}</td>
                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$route->departure_time)->format('h:i')}}</td>
                            <td>{{ $route->signups() }}</td>
                            <td>&euro;{{ $route->price }}</td>
                            <td>
                                <a href="{{route('festivals.order', [$festival, $route])}}">
                                    <x-primary-button>Order</x-primary-button>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td>No Routes</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
