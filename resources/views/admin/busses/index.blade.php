<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    {{-- Search bar --}}
                    <div class="flex flex-col lg:flex-row justify-between">
                    <div class="max-w-full pb-6 items-center">
                        <x-search-bar :action="route('admin.busses.index')" placeholder="Search busses..."></x-search-bar>
                    </div>
                    <div class="pb-6">
                    <a href="{{route('admin.busses.create')}}">
                        <x-primary-button>
                            Add new bus
                        </x-primary-button>
                    </a>
                    </div>
                    </div>
                    <div class="flex justify-center">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg min-w-full">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            License plate
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Currently in use
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Delete bus
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($busses as $bus)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $bus->license_plate }}
                                    </th>
                                        <td class="px-6 py-4">
                                            @if( $bus->id ) {{-- TODO: check if bus is currently in bus_in_uses --}}
                                            YES
                                            @else
                                            NO
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- delete bus -->
                                            <form method="post"
                                                  action="{{route('admin.busses.destroy', $bus->id)}}">
                                                @method('DELETE')
                                                @csrf
                                                <x-danger-button>Delete</x-danger-button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{-- Pagination link --}}
                            <div class="w-full flex justify-center p-8">
                                {{$busses->withQueryString()->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <a href="{{ route('admin.index') }}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
    </div>

</x-app-layout>