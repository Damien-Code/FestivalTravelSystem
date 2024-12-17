<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Festivals') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl m-auto">
                <form action="{{'festivals.index'}}" method="GET">
                    <input name="search" placeholder="..." type="text" class="text-black rounded-lg w-3/4">
                    <x-primary-button>Search</x-primary-button>
                </form>
            </div>
        </div>
        <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 gap-4">
            @foreach($festivals as $festival)
                    <div id="{{$festival->id}}"
                         class="p-4 sm:p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-col">
                        <p class="font-bold text-lg">{{$festival->festival_info->title}}</p>
                        <p class="font-bold text-lg">{{$festival->date}}</p>
                        <div class="flex flex-row h-full">
                            <div class="ml-auto mt-auto pl-2"><a href="{{ route('festivals.show', $festival->id) }}">
                                    <x-primary-button>Order</x-primary-button>
                                </a>
                            </div>
                        </div>
                    </div>
            @endforeach
</x-app-layout>
