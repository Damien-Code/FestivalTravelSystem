<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <!-- TODO: make action go to special page for searching -->
                <form method="get" action="{{route('festivals.show', 1)}}" class="flex flex-col w-56 text-white">
                    @csrf
                    <label>Festival</label>
                    {{-- TODO: add dropdown  --}}
                    <input class="rounded-lg w-56">
                    <label>Datum</label>
                    {{-- TODO: add calendar popup --}}
                    <input class="rounded-lg mb-6 w-56">
                    <x-primary-button>Bekijk busreizen</x-primary-button>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
