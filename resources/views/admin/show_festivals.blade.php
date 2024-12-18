<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <p>Naam</p>
                <p>Plaats</p>
                <p>Datum</p>
                <x-primary-button>Update</x-primary-button>
                <x-danger-button>Delete</x-danger-button>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                @if($errors->any())
                    {!! implode('', $errors->all('<div>:message</div>')) !!}
                @endif
                <form action="{{route('festivals.store')}}" method="post" enctype="multipart/form-data" class="text-black">
                    @csrf
                    <input type="text" name="title">
                    <input type="text" name="description">
                    <input type="file" name="image">
                    <x-primary-button >Save</x-primary-button>
                </form>
            </div>
        </div>
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <a href="{{route('admin.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
