<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="md:flex justify-between sm:flex-none">
                <p class="text-white text-3xl font-bold pb-6 md:pb-0">Routes</p>
                <div>
                    <a href="{{route('admin.routes.index')}}">
                        <x-primary-button>
                            Back
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6 text-white">
        {{-- Flash message --}}
        @include('layouts.error')
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-3xl">
                <form class="" action="{{ route('admin.routes.store') }}" method="post">
                    @csrf
                    <div class="relative z-0 w-full mb-5 group">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="festival" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select the festival</label>
                            <select id="festival" name="festival" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($festivals as $festival)
                                    <option value="{{$festival->id}}" @selected($festival->id == $route->festival_id)>{{$festival->festivalInfo->title}} / {{ \Carbon\Carbon::parse($festival->date)->format('Y-m-d') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <div class="relative z-0 w-full mb-5 group">
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select the location</label>
                            <select id="location" name="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}" @selected($location->id == $route->location_id)>{{ $location->address() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid md:grid-cols-2 md:gap-6">
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="date" min="{{date('Y-m-d')}}" @if($route->exists) value="{{ old('date', \Carbon\Carbon::parse($route->departure_time)->format('Y-m-d')) }}" @endif name="date" id="date" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="date" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Date of route</label>
                        </div>
                        <div class="relative z-0 w-full mb-5 group">
                            <input type="time" name="time" id="time" @if($route->exists) value="{{ old('time', \Carbon\Carbon::parse($route->departure_time)->format('H:i')) }}" @endif class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                            <label for="time" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Time of day</label>
                        </div>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="number" name="price" id="price" value="{{ old('price', $route->price) }}" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                        <label for="price" class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Price for ticket</label>
                    </div>
                    <x-primary-button>Save</x-primary-button>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
