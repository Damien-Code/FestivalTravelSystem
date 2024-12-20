<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <p class="text-white text-3xl font-bold">Festivals</p>
            </div>
        </div>
    </div>
    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
        <div class="max-w-xl m-auto">
            <form action="{{route('admin.festivals.index')}}" method="GET">
                <input name="search" placeholder="..." type="text" class="text-black rounded-lg w-3/4">
                <x-primary-button>Search</x-primary-button>
            </form>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <a href="{{route('admin.festivals.create')}}">
                    <x-primary-button>
                        Create new festivals
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-center">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Festival name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Description
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date:
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Location
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($festivals as $festival)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{$festival->festivalInfo->title}}
                                </th>
                                <td class="px-6 py-4">
                                    {{$festival->festivalInfo->description}}
                                </td>
                                <td class="px-6 py-4">
                                    {{$festival->date}}
                                </td>
                                <td class="px-6 py-4">
                                    Amsterdam
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{route('admin.festivals.edit', $festival->id)}}">
                                        <x-primary-button>
                                            Edit
                                        </x-primary-button>
                                    </a>
                                </td>
                                <td class="px-6 py-4">
                                    <form method="post" action="{{route('admin.festivals.destroy', $festival->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <x-danger-button>Delete</x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
