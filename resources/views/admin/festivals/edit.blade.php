<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="flex justify-between">
                <p>Festivals</p>
                {{-- Back button to return to index --}}
                <a href="{{route('admin.festivals.index')}}">
                    <x-primary-button>Back</x-primary-button>
                </a>
            </div>
        </div>
        <div>
            @include('layouts.success')
            @include('layouts.error')

            <div class="flex justify-between gap-6">
                <section class="w-1/2">
                    <div class="py-8 px-4 mx-auto max-w-3xl">
                        <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Update an existing
                            festival</h2>
                        <form action="{{route('admin.festivals.update', $festival->id)}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="title"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Festival
                                        Title</label>
                                    <input name="title"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Festival" required
                                           value="{{$festival->festivalInfo->title}}">
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="image"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                                    <input type="file" name="image" value="{{$festival->festivalInfo->image}}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    onchange="getFileSize(this)">
                                    <p>Files supported: JPEG, PNG and JPG. Max-size: 2048</p>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="description"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea name="description" rows="8"
                                              class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                              placeholder="Your description here"
                                              required> {{$festival->festivalInfo->description}} </textarea>
                                </div>
                                <input hidden value="{{$festival->date}}" name="date">
                                <input hidden value="{{$festival->id}}" name="festival">
                            </div>
                            <x-primary-button class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6">Update festival
                            </x-primary-button>
                        </form>
                    </div>
                </section>
                {{-- Form to update festival --}}
                <section class="w-1/2">
                    <div class="py-8 px-4 mx-auto max-w-2xl lg:py-16">
                        <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Pair an existing festival
                            to a
                            date and location</h2>
                        <form action="{{route('admin.festivals.updatePair', $festival->id)}}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                                <div class="sm:col-span-2">
                                    <label for="festival"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Festival</label>
                                    <select name="festival"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                        @foreach($festivalsInfo as $info)
                                            <option
                                                @selected($info->title == $festival->festivalInfo->title) value="{{$info->id}}">{{$info->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="sm:col-span-2">
                                    <label for="name"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Location</label>
                                    <input type="text" name="name" id="name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="What is the location?">
                                </div>
                                <div>
                                    <label for="date"
                                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                                    <input type="date" name="date" min="{{date('Y-m-d')}}"
                                           value="{{ \Carbon\Carbon::parse($festival->date)->format('Y-m-d') }}"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                </div>
                            </div>
                            <x-primary-button
                                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center">
                                Update
                            </x-primary-button>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        function getFileSize(el) {
            const size = el.files[0].size;
            let totalSize = Math.ceil(size / 1024);
            console.log(el.files[0].size)
            if (totalSize > 5120) {
                document.createElement('')
            }
        }
    </script>
</x-app-layout>
