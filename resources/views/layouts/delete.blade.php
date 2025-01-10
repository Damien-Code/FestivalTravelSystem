{{--Delete message after something has been deleted --}}
@if(session()->has('delete'))
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 pt-6">
        <div id="alert-1" class="flex items-center p-4 mb-4 rounded-lg bg-red-600 text-white"
             role="alert">
            {{session('delete')}}
            <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-gray-700 text-white rounded-lg p-1.5 hover:bg-gray-800 inline-flex items-center justify-center h-8 w-8"
                    data-dismiss-target="#alert-1" aria-label="Close"
                    onclick="return this.parentNode.remove()">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
            </button>
        </div>
    </div>
@endif
