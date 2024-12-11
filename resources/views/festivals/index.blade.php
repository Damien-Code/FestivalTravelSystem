<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Festivals') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <p>Festivals</p>
            </div>
        </div>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
            @for($i=0;$i<10;$i++)
                <div id="{{ $i }}" class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-col">
                    <p class="font-bold text-lg">{{ fake()->unique()->word() }} {{ $i }}</p>
                    <div class="flex flex-row h-full">
                        <div>{{ fake()->date('d-m-Y', '12-12-2026') }}</div>
                        <div class="ml-auto mt-auto pl-2"><a href="{{ route('festivals.show') }}" class="text-blue-400 hover:text-blue-600 dark:hover:text-white">Order</a></div>
                    </div>
                </div>
            @endfor
        </div>
{{--        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--            <div class="max-w-xl">--}}
{{--                <p>1</p>--}}
{{--                <a href="{{route('festivals.order')}}"><button class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Order</button></a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">--}}
{{--            <div class="max-w-xl">--}}
{{--                <p>2</p>--}}
{{--                <a href="{{route('festivals.order')}}"><button class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Order</button></a>--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</x-app-layout>
