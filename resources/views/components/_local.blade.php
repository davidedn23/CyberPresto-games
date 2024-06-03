<form action="{{ route('setLocale', $lang) }}" class="d-inline" method="POST">
    @csrf
    <button type="submit" class="btn btnHover">
        <img src="{{ asset('vendor/blade-flags/language-' . $lang . '.svg') }}" alt="" width="32" height="32"
            class="" />
    </button>
</form>
