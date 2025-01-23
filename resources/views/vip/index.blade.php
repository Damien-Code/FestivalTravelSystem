<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('VIP') }}
        </h2>
    </x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
                <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Welcome on the VIP benefits page{{auth()->user() ? ', '. auth()->user()->name : "."}}</h2>
                <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">Below you are able to see all of the benefits we currently provide in exchange for the points you have saved up.
                <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">The rate at which you earn points is 1:1 with the price of an order, i.e., an order of €150 earns you 150 points.</p>
            </div>
            <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">
                {{-- Discount element--}}
                <div class="flex flex-col col-start-2 p-6 mx-auto max-w-sm text-center text-gray-900 bg-white rounded-lg border border-gray-100 shadow lg:w-96 xl:p-8 dark:border-gray-600 dark:bg-gray-800 dark:text-white">
                    <h3 class="mb-4 text-2xl font-semibold">Discount</h3>
                    <p class="font-light text-gray-500 sm:text-lg dark:text-gray-400">Active</p>
                    <div class="flex flex-col justify-center my-8">
                        <span class="mr-2 text-5xl font-extrabold">20%</span>
                    </div>
                    {{-- Discount information --}}
                    <ul role="list" class="mb-8 space-y-4 mx-auto">
                        <li class="flex items-center space-x-3">
                            {{-- Bullet point --}}
                            <svg class="flex-shrink-0 w-5 h-5 text-black dark:text-gray-600" fill="currentColor" viewBox="0 0 20 20"  xmlns="http://www.w3.org/2000/svg"><circle cx="10" cy="10" r="10"></circle></svg>
                            <span>Cost: 100 Points</span>
                        </li>
                        <li class="flex items-center space-x-3">
                            {{-- Checkmark --}}
                            <svg class="flex-shrink-0 w-5 h-5 text-green-500 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            <span>No ticket limit</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
