<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    {{-- Search bar --}}
                    <div class="max-w-xl pb-6">

                        {{-- TODO: Add routing for user search bar --}}
                        <x-search-bar :action="route('admin.users.index')" placeholder="Search users..."></x-search-bar>
                    </div>

                    <div class="flex justify-center">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Email
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Role
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Change role
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $user->name }}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $user->email }}
                                            </td>
                                            <td class="px-6 py-4">
                                                @switch($user->role_id)
                                                    @case(1)
                                                        Admin
                                                    @break

                                                    @case(2)
                                                        User
                                                    @break

                                                    @case(3)
                                                        Busdriver
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class="px-6 py-4">
                                                <form class="inline-block float-end pb-2 " action="">
                                                    <select
                                                        class="items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 inline-block"
                                                        type="dropdown">
                                                        <option value="1">Admin</option>
                                                        <option value="2">User</option>
                                                        <option value="3">Busdriver</option>
                                                    </select>
                                                </form>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{-- Form to delete festival --}}
                                                <form method="post">
                                                    {{-- action="{{route('admin.festivals.destroy', $festival->id)}}"> --}}
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
                                {{-- {{$users->withQueryString()->links()}} --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="relative max-w-5xl left-2/4 -translate-x-2/4">

                <h2 class="inline-block">Users</h2>
                <form class="inline-block float-end pb-2 " action="">
                    <select
                        class="items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 inline-block"
                        type="dropdown" id="role_change">
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                        <option value="3">Busdriver</option>
                    </select>
                    <x-primary-button type="submit" class="inline-block">Save</x-primary-button>
                </form>

                @if (isset($users))

                    <div class="relative max-w-full">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Username
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Is Admin
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $user->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <input type="checkbox" name="is_admin" value="1"
                                                {{ $user->role_id == 1 ? 'checked' : '' }}>
                                        </td>
                                    </tr>
                                @endforeach()
                            </tbody>
                        </table>
                    </div>
                @else(
                    <h3>ERROR: No users are found</h3>
                    )
                @endif
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
