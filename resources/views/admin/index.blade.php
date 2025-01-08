<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>
    <div class="sm:px-6 lg:px-8 pt-6 text-white flex justify-between h-96 gap-6 max-w-full">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-1/3">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-2xl pb-10">Gebruikers</p>
                    <p>Totaal aantal gebruikers: {{$usersCount}}</p>
                </div>
                <a href="{{route('admin.show_users')}}">
                    <x-primary-button>Edit</x-primary-button>
                </a>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-1/3">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-2xl pb-10">Festivals</p>
                    <p>Totaal aantal festivals: 49</p>
                </div>
                <a href="{{route('admin.show_festivals')}}">
                    <x-primary-button>Edit</x-primary-button>
                </a>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg w-1/3">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-3xl pb-10">Busreizen</p>
                    <p>Totaal aantal busreizen ingezet: 324</p>
                </div>
                <a href="{{route('admin.show_busses')}}">
                    <x-primary-button>Edit</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
