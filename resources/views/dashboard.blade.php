<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<div class="flex justify-between">
    <div class="py-12">
        <div class="max-w-7xl sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8 w-96 h-16">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Good morning, {{auth()->user()->name }} </p>
                </div>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg w-96 h-24">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p>Saved up points:</p>
                    <p class="text-3xl">{{ auth()->user()->tokens }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="max-w-7xl sm:px-6 lg:px-8 w-3/5 pt-12">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg mb-8 w-4/5 mx-auto p-6">
                    <p class="text-2xl ">Travel history</p>
                </div>
{{--                TODO: load all orders in--}}
                @foreach($orders as $order)
                    <div class="flex justify-between bg-gray-900 rounded-lg p-6 mb-6">
                        <p>Festival: {{ $order->route->festival->festivalInfo->title }}</p>
                        <p>Start location: {{ $order->route->location->address() }}</p>
                        <p>Order date: {{ $order->created_at }}</p>
                        <p>Tickets bought: {{ $order->amount_of_tickets }}</p>
                        <p>Price: {{ $order->final_price }} </p>
                        <p>Used discount: @if($order->tokens_used > 0) Yes @else No @endif</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

</x-app-layout>
