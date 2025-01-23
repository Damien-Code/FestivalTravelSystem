<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Contact Message') }}
            </h2>
            <div>
                <a href="{{route('admin.contact.index')}}">
                    <x-primary-button>
                        Back
                    </x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>
    <section class="bg-white dark:bg-gray-900">
        <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-center text-gray-900 dark:text-white">Contact Page</h2>
            <div class="flex flex-row gap-2 justify-end">
                <a href="mailto:{{ $contact->email }}"><x-secondary-button>Email</x-secondary-button></a>
                <div class="mb-4 text-right">
                    <form action="{{ route('admin.contact.destroy', $contact) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>Delete</x-danger-button>
                    </form>
                </div>
            </div>
            <section class="space-y-8">
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Email</label>
                    <input readonly value="{{ $contact->email }}" type="email" name="email" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="test@test.com" required>
                </div>
                <div>
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                    <input readonly value="{{ $contact->name }}" type="text" name="name" class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light" placeholder="What is your name?" required>
                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Message</label>
                    <textarea readonly name="message" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Leave a comment...">{{ $contact->message }}</textarea>
                </div>
            </section>
        </div>
    </section>
</x-app-layout>
