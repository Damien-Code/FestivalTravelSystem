<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg flex justify-between">
            <div class="max-w-xl text-2xl">
                <p>Create festivals</p>
            </div>
            <a href="{{route('admin.festivals.index')}}">
                <x-primary-button>Back</x-primary-button>
            </a>
        </div>
        {{-- Flash message --}}
        @include('layouts.success')
        @include('layouts.error')
        <div id="fileSizeError"></div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-3xl">
                <h2 class="mb-4 text-2xl font-bold text-gray-900 dark:text-white">Add a new festival</h2>
                <form action="{{route('admin.festivals.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                        <div class="sm:col-span-2">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Festival
                                Title</label>
                            <input name="title"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Festival" required="">
                        </div>
                        <div class="sm:col-span-2">
                            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Image</label>
                            <input type="file" name="image" id="image"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    {{--                                   onchange="getFileSize(this)"--}}
                            >
                            <p id="fileName">Files supported: JPEG, PNG and JPG. Max-size: 5mb</p>
                        </div>
                        <div class="sm:col-span-2">
                            <label for="description"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                            <textarea name="description" rows="8"
                                      class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Your description here" required></textarea>
                        </div>
                    </div>
                    <x-primary-button class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6">Add festival
                    </x-primary-button>
                </form>
            </div>
        </section>
    </div>
    {{--    <script>--}}
    {{--        function getFileSize(el) {--}}
    {{--            const size = el.files[0].size;--}}
    {{--            let totalSize = Math.ceil(size/1024);--}}
    {{--            console.log(el.files[0].size)--}}
    {{--            if(totalSize > 5120){--}}
    {{--                alert('file too big')--}}
    {{--            }--}}
    {{--        }--}}
    {{--    </script>--}}
    <script>
        const file = document.getElementById('image')
        const text= document.getElementById('fileName')
        file.addEventListener('change', (event) => {
            const target = event.target
            if (target.files && target.files[0]) {
                const maxAllowedSize = 5 * 1024 * 1024;
                if (target.files[0].size > maxAllowedSize) {
                    target.value = ''
                    file.classList.remove('dark:border-gray-600')
                    file.classList.remove('border-green-500')
                    file.classList.add('border-rose-500')
                    text.innerText = 'File is not supported, please select JPEG, PNG or JPG and not bigger than 5MB'
                } else {
                    file.classList.remove('dark:border-gray-600')
                    file.classList.add('border-green-500')
                    text.innerText = 'Image is supported to upload'
                }
            }
        })
    </script>
</x-app-layout>
