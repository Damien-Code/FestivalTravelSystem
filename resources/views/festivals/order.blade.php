<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <form class="flex flex-col w-56 text-white" action="{{route('festivals.index')}}">
                    <label>Naam</label>
                    <input class="rounded-lg">
                    <label>Email</label>
                    <input class="rounded-lg">
                    <label>Festival</label>
                    <input class="rounded-lg">
                    <label>VIP punten</label>
                    <input class="rounded-lg">
                    <label>Prijs</label>
                    <input class="rounded-lg mb-8">
                    <x-primary-button>Bestel Ticket</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
