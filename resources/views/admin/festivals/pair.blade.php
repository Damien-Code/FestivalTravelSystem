<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <p class="text-2xl">Pair Festivals</p>
                <a href="{{route('admin.festivals.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
        {{-- flash success message --}}
        @include('layouts.success')
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Pair an existing festival to a date and location</h2>
                <form action="{{route('admin.festivals.planFestival')}}" method="post">
                    @csrf
                    @method('POST')
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="festival" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Festival</label>
                            <select name="festival" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($festivalsInfo as $info)
                                    <option value="{{$info->id}}">{{$info->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                            <select id="location" name="location" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($locations as $location)
                                    <option value="{{$location->id}}">{{ $location->address() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="date" name="date" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        </div>
                    </div>
                    <x-primary-button class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center">Add</x-primary-button>
                </form>
            </div>
        </section>
    </div>
</x-app-layout>
