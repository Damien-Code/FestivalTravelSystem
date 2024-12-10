<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>
    <div class="flex justify-center items-center text-white h-screen gap-10">
        <div class="h-56 w-56 bg-blue-900">
            <p>Gebruikers</p>
            <a href="{{route('admin.show_users')}}">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
            </a>
        </div>
        <div class="h-56 w-56 bg-blue-900">
            <p>Festivals</p>
            <a href="{{route('admin.show_festivals')}}">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
            </a>
        </div>
        <div class="h-56 w-56 bg-blue-900">
            <p>Busreizen</p>
            <a href="{{route('admin.show_busses')}}">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
            </a>
        </div>
    </div>
</x-app-layout>
