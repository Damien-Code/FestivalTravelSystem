<x-app-layout>
    <div>
        <div>
            <p>Gebruikers</p>
            <a href="{{route('admin.show_users')}}">
                <button>Edit</button>
            </a>
        </div>
        <div>
            <p>Festivals</p>
            <a href="{{route('admin.show_festivals')}}">
                <button>Edit</button>
            </a>
        </div>
        <div>
            <p>Busreizen</p>
            <a href="{{route('admin.show_busses')}}">
                <button>Edit</button>
            </a>
        </div>
    </div>
</x-app-layout>
