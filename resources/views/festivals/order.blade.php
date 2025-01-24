<x-app-layout>
    <section class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
        <form action="{{route('order.store', [$festival, $route])}}" method="POST" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            @include('layouts.error')
            @csrf
            <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
                <div class="min-w-0 flex-1 space-y-8">
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Order Details</h2>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="your_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Your name </label>
                                <input type="text" id="your_name" value="{{auth()->user()->name ?? "no name"}}" disabled class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                            </div>
                            <div>
                                <label for="your_email" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Your email </label>
                                <input type="email" id="your_email" value="{{auth()->user()->email ?? "no name"}}" disabled class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                            </div>
                            <div>
                                <label for="festival_name" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Festival name </label>
                                <input type="text" id="festival_name" value="{{$festival->festivalInfo->title ?? "no festival name"}}" disabled class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                            </div>
                            <div>
                                <label for="festival_route" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Festival route </label>
                                <input type="text" id="festival_route" value="{{$route->location->address() ?? "no festival location"}}" disabled class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                            </div>
                            <div>
                                <label for="departure_time" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Departure time </label>
                                <input type="text" id="departure_time" value="{{$route->departure_time ?? "no departure time"}}" disabled class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                            </div>
                            <div class="flex flex-row justify-between gap-2">
                                <div class="w-3/4">
                                    <label for="ticket-amount" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Tickets </label>
                                    <input type="number" id="ticket-amount" name="ticket-amount" value="1" min="1" max="35" oninput="CheckTicketInput(this)" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                                    <input type="hidden" id="ticket-price" value="{{$route->price}}">
                                    <input type="hidden" id="total-price-h" name="total-price-h" value="{{$route->price}}"></div>
                                <div class="w-1/4">
                                    @if(auth()->user()->tokens > 100)
                                        <label for="vip-checkbox" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> VIP Discount </label>
                                        <div class="h-10 flex items-center justify-center border border-gray-600 rounded dark:bg-gray-700">
                                            <input type="checkbox" id="vip-checkbox" name="vip-checkbox" onclick="UpdatePrice()" class="block rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-400 dark:bg-gray-700 dark:text-gray-600 dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                                        </div>
                                    @else
                                        <label for="insufficient-tokens" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> VIP Discount </label>
                                        <input type="text" id="insufficient-tokens" value="Ineligible :(" disabled class="block h-10 w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500" />
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                    <div class="flow-root">
                        <div class="-my-3 divide-y divide-gray-200 dark:divide-gray-800">
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
                                <dd id="subtotal" class="text-base font-medium text-gray-900 dark:text-white">0.00</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Savings</dt>
                                <dd id="total-savings" class="text-base font-medium text-green-500">0.00</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
                                <dd id="total-price" class="text-base font-bold text-gray-900 dark:text-white">0.00</dd>
                            </dl>
                        </div>
                    </div>

                    <div class="space-y-3">
                        <button type="submit" class="flex w-full items-center justify-center border rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Order your tickets!</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
</x-app-layout>

<script>
    /**
     * Keeps the value of the field from fallen outside the set min & max
     * @param field
     * @author Ismael Winterman
     */
    function CheckTicketInput(field){
        //Set field value to max if it exceeds the max value
        if(parseInt(field.value) > parseInt(field.max)){
            field.value = field.max;
        }
        //Set field value to min if it falls below the min value
        else if(parseInt(field.value) < parseInt(field.min)){
            field.value = field.min;
        }

        UpdatePrice();
    }

    /**
     * Calculates price, savings with discount if applicable and rounds the price on 2 decimal
     * @author Ismael Winterman
     */
    function UpdatePrice() {
        //Obtain current inputs from the form
        let ticketPrice = document.getElementById("ticket-price").value;
        let ticketAmount = document.getElementById("ticket-amount").value;

        //Set a 20% discount If VIP checkbox is present & checked
        let discountModifier = document.getElementById("vip-checkbox")?.checked ? 0.8 : 1;

        //Calculate both the subtotal & final price
        let subtotal = (ticketPrice * ticketAmount).toFixed(2);
        let finalPrice = (ticketPrice * ticketAmount * discountModifier).toFixed(2);

        //Set price and savings values
        document.getElementById("subtotal").innerHTML = subtotal;
        document.getElementById("total-savings").innerHTML = (subtotal - finalPrice).toFixed(2);
        document.getElementById("total-price").innerHTML = finalPrice;
        document.getElementById("total-price-h").value = finalPrice;
    }
</script>
