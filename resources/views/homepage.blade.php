<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Home') }}
        </h2>
    </x-slot>
        <form method="get" action="{{route('festivals.show')}}" class="flex flex-col w-56 text-white">
            @csrf
            <label>Festival</label>
            <input>
            <label>Startlocatie</label>
            <input>
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Bekijk busreizen</button>
        </form>
</x-app-layout>
