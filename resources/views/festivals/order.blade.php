<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex flex-row justify-between">
            <div class="max-w-xl mr-4">
                <form class="flex flex-col gap-2 w-80" action="{{route('festivals.index')}}">
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{auth()->user()->name ?? "no name"}}" readonly>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="{{auth()->user()->email ?? "no email"}}" readonly>
                    <!--PULLED FROM DB MODEL-->
                    <!--TODO: DATA MUST BE PASSED FROM PREVIOUS PAGE OR URI-->
                    <input class="rounded-lg bg-neutral-300 text-gray-400" value="festival id: {{$festival}}" readonly>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" placeholder="start locatie" readonly>
                    <input class="rounded-lg bg-neutral-300 text-gray-400" placeholder="vertrekdatum" readonly>
                    <div class="flex justify-between border rounded-lg p-2">
                        <label class="text-white">Gebruik VIP punten</label>
                        <input id="vip-checkbox" class="h-5 w-5 rounded bg-neutral-300 text-gray-400" type="checkbox" onclick="UpdatePrice()">
                    </div>
                    <div class="flex flex-row justify-between gap-2">
                        <input id="ticket-amount" type="number" class="rounded-lg w-1/2" value="1" MIN="1" MAX="35" onclick="UpdatePrice()">
                        <input id="total-price" class="rounded-lg w-1/2" type="text" value="30.95" readonly>
                    </div>
                    <!--Hidden input hardcoded, only used for initial logic testing-->
                    <!--TODO: VALUE MUST BE PULLED FROM PREVIOUS PAGE DATA-->
                    <input id="ticket-price" type="hidden" value="30.95">
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
