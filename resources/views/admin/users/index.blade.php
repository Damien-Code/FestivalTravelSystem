<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="md:flex justify-between sm:flex-none">
                <p class="text-white text-3xl font-bold pb-6 md:pb-0">Users</p>
                <div>
                    <a href="{{route('admin.index')}}">
                        <x-primary-button>
                            Back
                        </x-primary-button>
                    </a>
                </div>
            </div>
        </div>
        @include('layouts.success')
        @include('layouts.error')
        <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-7xl mx-auto mt-6">
                <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                    {{-- Search bar --}}
                    <div class="max-w-full pb-6 items-center">

                        {{-- TODO: Add routing for user search bar --}}
                        <x-search-bar :action="route('admin.users.index')" placeholder="Search users..."></x-search-bar>
                    </div>

                    <div class="flex justify-center">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg min-w-full">
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
                                            {{ ucfirst($user->role->role_name) }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <form name="role_form" class="inline-block float-end pb-2 "
                                                  action="{{route('admin.users.update', $user->id)}}" method="POST">
                                                @method('PATCH')
                                                @csrf
                                                <input type="hidden" value="test_value">
                                                <select
                                                    class="items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 inline-block"
                                                    type="dropdown"
                                                    onChange="this.closest('form').submit();"
                                                    name="role_id">
                                                    <option value="1" @if($user->role_id == 1) selected @endif>Admin
                                                    </option>
                                                    <option value="2" @if($user->role_id == 2) selected @endif>User
                                                    </option>
                                                    <option value="3" @if($user->role_id == 3) selected @endif>Driver
                                                    </option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="px-6 py-4">
                                            <!-- delete user -->
                                            <form method="post"
                                                  action="{{route('admin.users.destroy', $user->id)}}">
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
                                {{$users->withQueryString()->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</x-app-layout>
