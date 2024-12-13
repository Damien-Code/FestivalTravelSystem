<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="flex justify-between">
    <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 w-96 h-24">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("Goedemiddag, 'user'") }}
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96 h-36">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Totaal gespaarde punten:</p>
                    <p class="text-3xl">1200</p>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl sm:px-6 lg:px-8 w-3/5 pt-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-8 w-4/5 mx-auto p-6">
                    <p class="text-2xl ">Reisgeschiedenis</p>
                </div>
                <div class="flex justify-between bg-gray-900 rounded-lg p-6 mb-6">
                    <p>Festival</p>
                    <p>Datum boeking</p>
                    <p>Locatie</p>
                </div>
                <div class="flex justify-between bg-gray-900 rounded-lg p-6 mb-6">
                    <p>Festival</p>
                    <p>Datum boeking</p>
                    <p>Locatie</p>
                </div>
                <div class="flex justify-between bg-gray-900 rounded-lg p-6 mb-6">
                    <p>Festival</p>
                    <p>Datum boeking</p>
                    <p>Locatie</p>
                </div>
                <div class="flex justify-between bg-gray-900 rounded-lg p-6 mb-6">
                    <p>Festival</p>
                    <p>Datum boeking</p>
                    <p>Locatie</p>
                </div>
            </div>
        </div>
    </div>
</div>

</x-app-layout>
