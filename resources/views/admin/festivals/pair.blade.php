<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <p class="text-2xl">Festivals</p>
                <a href="{{route('admin.festivals.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
        {{-- flash success message --}}
        @include('layouts.success')
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-between min-w-full">
            <div class="max-w-xl h-72">
                {{-- Form to plan a festival and link it to a date --}}
                <form action="{{route('admin.festivals.planFestival')}}" method="post"
                      class="text-black flex flex-col justify-evenly min-h-full">
                    @csrf
                    @method('POST')
                    <label class="text-white text-2xl">Pair a festival:</label>
                    <select name="festival" class="rounded-lg">
                        @foreach($festivalsInfo as $info)
                            <option value="{{$info->id}}" class="text-black">{{$info->title}}</option>
                        @endforeach
                    </select>
                    {{-- Location will be used after location is finished --}}
                    <input type="text" class="rounded-lg" placeholder="Location">
                    <input type="date" name="date" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" class="rounded-lg">
                    <x-primary-button>Save</x-primary-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
