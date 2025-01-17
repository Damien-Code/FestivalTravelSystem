<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact') }}
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 ">
        @include('layouts.error')
        @include('layouts.success')
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <form class="flex flex-col w-56" method="post" action="{{ route('contact.store') }}">
                    @csrf
                    <label class="text-white">Naam</label>
                    <input required type="text" name="name" class="rounded-lg">
                    <label class="text-white">Email</label>
                    <input required type="email" name="email" class="rounded-lg">
                    <label class="text-white">Bericht</label>
                    <textarea required rows="8" name="message" class="rounded-lg mb-8"></textarea>
                    <x-primary-button>Send</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
