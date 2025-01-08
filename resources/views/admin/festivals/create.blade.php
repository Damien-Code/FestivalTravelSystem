<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <p>Festivals</p>
            </div>
        </div>
        @if(session()->has('success'))
            <div id="alert-1" class="flex items-center p-4 mb-4 rounded-lg bg-green-300 text-black" role="alert">
                {{session('success')}}
                <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-1" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
        @endif
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-between min-w-full">
            <div class="max-w-xl h-72">
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
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

        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <a href="{{route('admin.festivals.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
