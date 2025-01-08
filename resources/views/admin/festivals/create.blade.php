<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <p>Festivals</p>
            </div>
        </div>
        {{-- Flash message --}}
        @include('layouts.success')

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-between min-w-full">
            <div class="max-w-xl h-72">
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
                {{-- Form to create new festival --}}
                <form action="{{route('admin.festivals.store')}}" method="post" enctype="multipart/form-data"
                      class="text-black flex flex-col justify-evenly min-h-full">
                    @csrf
                    <label class="text-white text-2xl">Create a new festival:</label>
                    <input type="text" name="title" class="rounded-lg" placeholder="Title">
                    <input type="text" name="description" class="rounded-lg" placeholder="Description">
                    <input type="file" name="image" class="rounded-lg bg-gray-50">
                    <x-primary-button>Save</x-primary-button>
                </form>
            </div>
        </div>

        {{-- Back button to return to index --}}
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <a href="{{route('admin.festivals.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
