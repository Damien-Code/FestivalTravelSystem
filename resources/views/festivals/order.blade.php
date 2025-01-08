<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-row justify-between">
            <div class="max-w-xl mr-4">
            @include('layouts.error')
                <form class="flex flex-col gap-2 w-80" method="POST" action="{{route('order.store', [$festival, $route])}}">
                    @csrf
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{auth()->user()->name ?? "no name"}}" disabled>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{auth()->user()->email ?? "no email"}}" disabled>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{$festival->festivalInfo->title ?? "no festival title"}}" disabled>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{$route->location->country . " " . $route->location->city . " " . $route->location->address ?? "no festival location"}}" disabled>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{$route->departure_time ?? "no festival departure time"}}" disabled>
                    <div class="flex justify-between border rounded-lg p-2">
                        <label class="text-white">Gebruik VIP punten</label>
                        <input name="vip-checkbox" id="vip-checkbox" class="h-5 w-5 rounded bg-neutral-300 text-gray-400" type="checkbox" onclick="UpdatePrice()">
                    </div>
                    <div class="flex flex-row justify-between gap-2">
                        <input name="ticket-amount" id="ticket-amount" type="number" class="rounded-lg w-1/2" value="1" MIN="1" MAX="35" onblur="UpdatePrice()" onclick="UpdatePrice()">
                        <span class="valuta">
                            <input name="total-price" id="total-price" class="rounded-lg pl-4" type="text" value="{{$route->price}}" readonly>
                        </span>
                    </div>
                    <input id="ticket-price" type="hidden" value="{{$route->price}}">
                    <x-primary-button class="justify-center">Bestel Ticket</x-primary-button>
                </form>
            </div>
            <div>
                <figure>
                    <img src="{{url('/assets/img.png')}}" alt="test">
                </figure>
            </div>
        </div>
    </div>
    <!--url error handling. Check if festival id is the same route id, else throw error page-->
</x-app-layout>

<script>
    /* Calculates price, applies discount if applicable and rounds the price on 2 decimals */
    function UpdatePrice(){
        /* Obtain current inputs from the form */
        let ticketPrice = document.getElementById("ticket-price").value;
        let ticketAmount = document.getElementById("ticket-amount").value;
        let isVIPCheckbox = document.getElementById("vip-checkbox").checked;

        const ticketTotalPrice = document.getElementById("total-price");

        /* Default is full price so default value of 1 (100%) */
        let discount = 1;

        /* Apply 20% discount if true */
        if(isVIPCheckbox){
            discount = 0.8;
        }

        /* Set price value */
        ticketTotalPrice.value = (ticketPrice * ticketAmount) * discount.toFixed(2)
    }
</script>
