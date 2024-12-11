<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6 text-white">
        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
            <div class="max-w-xl">
                <table class="text-2xl text-white">
                    <thead>
                    <tr>
                        <th>Vertrek Locatie</th>
                        <th>Vertrektijden</th>
                        <th>Aanmeldingen</th>
                        <th>Prijs</th>
                        <th>Bestel</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>Almere</td>
                        <td>13:00</td>
                        <td>23/35</td>
                        <td>$15</td>
                        <td><a href="{{route('festivals.order', 1)}}"><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Bestel</button></a></td>
                    </tr>
                    <tr>
                        <td>Amsterdam</td>
                        <td>14:30</td>
                        <td>13/35</td>
                        <td>$15</td>
                        <td><a href="{{route('festivals.order', 1)}}"><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Bestel</button></a></td>
                    </tr>
                    <tr>
                        <td>Berlijn</td>
                        <td>05:00</td>
                        <td>33/35</td>
                        <td>$35</td>
                        <td><a href="{{route('festivals.order', 1)}}"><button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Bestel</button></a></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
