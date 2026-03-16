
<li class="d-flex">
    {{-- bottone per cambiare la lingua --}}
    <form class="d-inline" action="{{route('setLocale', $lang)}}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item textColor">
            {{-- immagine bandierina --}}
            <img src="{{ asset('vendor/blade-flags/language-') . $lang . '.svg' }}" width="32" height="32">

            <div class="ms-5 me-0">{{ $language }}</div>
        </button>
    </form>
    
</li>
    