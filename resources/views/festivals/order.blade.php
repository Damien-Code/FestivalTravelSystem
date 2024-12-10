<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <form class="flex flex-col w-56 text-white" action="{{route('festivals.index')}}">
                    <label>Naam</label>
                    <input>
                    <label>Email</label>
                    <input>
                    <label>Festival</label>
                    <input>
                    <label>VIP punten</label>
                    <input>
                    <label>Prijs</label>
                    <input>
                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Bestel Ticket</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
