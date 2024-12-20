<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <p class="text-white text-3xl font-bold">Festivals</p>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <a href="{{route('admin.festivals.create_festivals')}}">
                    <x-primary-button>
                        Create new festivals
                    </x-primary-button>
                </a>
                <a href="{{route('admin.festivals.edit_festivals')}}">
                    <x-primary-button>
                        Edit festival
                    </x-primary-button>
                </a>

            </div>
        </div>
    </div>

</x-app-layout>
