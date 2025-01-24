<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <section class="bg-white antialiased dark:bg-gray-900 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            @include('layouts.success')
            @include('layouts.error')
            @include('layouts.delete')
            <div class="mx-auto max-w-5xl">
                <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>
                    {{--Total points--}}
                    <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-2 text-gray-900 dark:text-gray-100">
                                <p>Your saved up points:</p>
                                <p class="text-3xl">{{ auth()->user()->tokens }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                {{--List of all the orders--}}
                <div class="mt-6 flow-root sm:mt-8">
                    <div class="divide-y divide-gray-200 dark:divide-gray-700">
                        @forelse($orders as $order)
                            <div class="flex flex-wrap items-center gap-y-4 py-6">
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">#{{ $order->id }}</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order date:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->created_at->format('Y-m-d') }}</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Festival:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->route->festival->festivalInfo->title }}</dd>
                            </dl>
                            <dl class="w-1/2 pl-0 sm:w-1/4 lg:w-auto lg:flex-1 lg:pl-2">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Start location:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->route->location->address() }}</dd>
                            </dl>
                            <dl class="w-1/2 pl-0 sm:w-1/4 lg:w-auto lg:flex-1 lg:pl-3">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Ticket quantity:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $order->amount_of_tickets }}</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                                <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">€{{ $order->final_price }}</dd>
                            </dl>
                            <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Discount:</dt>
                                @if($order->tokens_used > 0)
                                    {{--SVG Green rectangle with a checkmark saying yes--}}
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800 dark:bg-green-900 dark:text-green-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 11.917 9.724 16.5 19 7.5" />
                                        </svg>
                                        Yes
                                    </dd>
                                @else
                                    {{--SVG Red rectangle with an X saying no--}}
                                    <dd class="me-2 mt-1.5 inline-flex items-center rounded bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300">
                                        <svg class="me-1 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                        No
                                    </dd>
                                @endif
                            </dl>
                            @if($order->route->departure_time > now())
                                <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                                    <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Cancel order:</dt>
                                    <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                            <form action="{{ route('order.destroy', $order) }}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <x-danger-button>
                                                    Cancel
                                                </x-danger-button>
                                            </form>
                                    </dd>
                                </dl>
                            @endif
                        </div>
                        @empty
                            <div class="bg-white dark:bg-gray-800 max-w-fit overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-2 text-gray-900 dark:text-gray-100">
                                    <p>You have not placed any orders yet.</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
