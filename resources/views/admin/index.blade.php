<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin') }}
        </h2>
    </x-slot>
    <div class="sm:px-6 lg:px-8 pt-6 text-white grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 h-80 gap-6 max-w-full">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-3xl pb-10">Users</p>
                    <p>Total amount of users: {{$usersCount}}</p>
                </div>
                <a href="{{route('admin.users.index')}}">
                    <x-primary-button>View users</x-primary-button>
                </a>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-3xl pb-10">Festivals</p>
                    <p>Total amount of festivals: {{$festivalCount}}</p>
                </div>
                <div class="flex justify-between">
                    <a href="{{route('admin.festivals.index')}}">
                        <x-primary-button>View festivals</x-primary-button>
                    </a>
                </div>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-3xl pb-10">Bus trips</p>
                    <p>Total amount of bus routes: {{$routesCount}}</p>
                </div>
                <a href="{{route('admin.routes.index')}}">
                    <x-primary-button>View bus routes</x-primary-button>
                </a>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-3xl pb-10">Locations</p>
                </div>
                <a href="{{route('admin.locations.index')}}">
                    <x-primary-button>View locations</x-primary-button>
                </a>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl flex justify-between flex-col h-full">
                <div>
                    <p class="text-3xl pb-10">Contact Messages</p>
                    <p>Total amount of messages: {{$contactsCount}}</p>
                </div>
                <a href="{{route('admin.contact.index')}}">
                    <x-primary-button>View messages</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
