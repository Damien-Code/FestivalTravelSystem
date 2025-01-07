<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <p>Festivals</p>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-between min-w-full">
            <div class="max-w-xl h-72">
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
                <form action="{{route('admin.routes.store')}}" method="post"
                      class="text-black flex flex-col justify-evenly min-h-full">
                    @csrf
                    <label class="text-white text-2xl">Create a new route:</label>
                    <select name="festival" class="rounded-lg">
                        @foreach($festivals as $info)
                            <option value="{{$info->id}}" class="text-black">{{$info->festivalInfo->title}} / {{ \Carbon\Carbon::parse($info->date)->format('Y-m-d') }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="location" class="rounded-lg" placeholder="Location">
                    <input type="date" min="{{date('Y-m-d')}}" value="{{date('Y-m-d')}}" name="date" class="rounded-lg" placeholder="date">
                    <input type="time" name="time" class="rounded-lg">
                    <input type="number" step="0.01" min="0" name="price" class="rounded-lg" placeholder="Price">
                    <x-primary-button>Save</x-primary-button>
                </form>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <a href="{{route('admin.routes.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
