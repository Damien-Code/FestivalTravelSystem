<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Messages') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6 ">
        @include('layouts.error')
        @include('layouts.success')
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-center">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Message
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Show</span>
                            </th>
                            <th scope="col" class="px-6 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($contacts as $contact)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ $contact->email }}
                                </th>
                                <td class="px-6 py-4">
                                    {{ $contact->name }}
                                </td>
                                <td class="px-6 py-4">
                                    <p class="line-clamp-2">{{ $contact->message }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('admin.contact.show', $contact) }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">show</a>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <form action="{{ route('admin.contact.destroy', $contact) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <x-danger-button>Delete</x-danger-button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <th class="px-6 py-4 text-center" colspan="5">No Contact Messages</th>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
