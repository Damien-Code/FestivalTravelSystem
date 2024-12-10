<x-app-layout>
    <div class="text-white">
        <p>Gebruikers</p>
        <div>
            <p>Username</p>
            <p>Email</p>
            <form method="post">
                <input type="checkbox">
            </form>
        </div>
    </div>
    <a href="{{route('admin.index')}}"><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Back</button></a>
</x-app-layout>


