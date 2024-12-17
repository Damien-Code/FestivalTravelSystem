<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <form class="flex flex-col w-56" action="{{route('festivals.index')}}">
                    <label class="text-white">Naam</label>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{auth()->user()->name ?? "no name"}}" readonly>
                    <label class="text-white">Email</label>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{auth()->user()->email ?? "no email"}}" readonly>
                    <!--NEEDS TO BE PULLED FROM DB MODEL-->
                    <label class="text-white">Festival</label>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{"TODO"}}" readonly>
                    <!--NEEDS TO BE A CHECKBOX-->
                    <label class="text-white">VIP punten</label>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{"TODO"}}">
                    <label class="text-white">Aantal:</label>
                    <input type="number" class="rounded-lg" value="1" MIN="1" MAX="35">
                    <!--NEEDS TO BE CALCULATED WITH TICKET * AMOUNT * VIP DISCOUNT(optional)-->
                    <label class="text-white">Prijs:</label>
                    <input class="rounded-lg mb-6" type="text" disabled>
                    <x-primary-button>Bestel Ticket</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
