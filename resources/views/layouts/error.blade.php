<div id="error-list">
    @if($errors->any())
        <ul>
            @foreach($errors->all() as $error)
                <div class="flex items-center p-2 mb-2 text-white rounded bg-red-600" role="alert">
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium mr-1">
                        <strong>Whoops!</strong> {{ $error }}
                    </div>
                    <button type="button" class="ms-auto -my-1.5 text-white rounded-lg hover:ring-1 hover:ring-white p-1.5 inline-flex items-center justify-center h-6 w-6" onclick="return this.parentNode.remove()">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                    </button>
                </div>
            @endforeach
        </ul>
    @endif
</div>
