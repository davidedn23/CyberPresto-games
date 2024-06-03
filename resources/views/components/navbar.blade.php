<div>
    <nav class="navbar navbar-expand-lg my-0 p-0">
        <div class="container-fluid">
            {{-- HOME --}}
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="/storage/img/logoblack.png" class="imgNav" alt="">
            </a>
            <div class="nav-item dropdown lang-item d-flex d-lg-none">
                <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                    @if (__('ui.Articoli') == 'Articoli')
                        <img src="{{ asset('vendor/blade-flags/language-' . 'it' . '.svg') }}" alt=""
                            width="32" height="32" class="" />
                    @elseif (__('ui.Articoli') == 'Artículos')
                        <img src="{{ asset('vendor/blade-flags/language-' . 'es' . '.svg') }}" alt=""
                            width="32" height="32" class="" />
                    @elseif (__('ui.Articoli') == 'Articles')
                        <img src="{{ asset('vendor/blade-flags/language-' . 'en' . '.svg') }}" alt=""
                            width="32" height="32" class="" />
                    @endif
                </button>
                <ul class="dropdown-menu dropdown-custom">
                    <li class="@if (__('ui.Articoli') == 'Articles') d-none @endif"><x-_local lang="en" /></li>
                    <li class="@if (__('ui.Articoli') == 'Artículos') d-none @endif"><x-_local lang="es" /></li>
                    <li class="@if (__('ui.Articoli') == 'Articoli') d-none @endif"><x-_local lang="it" /></li>
                </ul>
            </div>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    {{-- TUTTI I PORDOTTI  --}}
                    <li class="nav-item mx-1">
                        <a class="nav-link fw-bold @if (Route::currentRouteName() == 'announcement.indexAll') active @endif" aria-current="page"
                            href="{{ route('announcement.indexAll') }}">{{ __('ui.Articoli') }}</a>
                    </li>
                    {{-- SEZIONI REVISOR --}}
                    @auth
                        @if (Auth::user()->is_revisor)
                            <li class="nav-item mx-1">
                                <a class="nav-link fw-bold  btn btn-outline success btn-sm position-relative w-sm-25 text-start @if (Route::currentRouteName() == 'revisor.index') active @endif"
                                    href="{{ route('revisor.index') }}">{{ __('ui.Zona revisore') }}
                                    @if (Route::currentRouteName() != 'revisor.index')
                                        <span
                                            class="position-absolute top-0 start- translate-middle badge rounded-pill bg-dark
                                    @if (\App\Models\Announcement::toBeRevisedCount() <= 0) d-none @endif">{{ \App\Models\Announcement::toBeRevisedCount() }}</span>
                                </a>
                        @endif
                        </a>
                        </li>
                        @endif
                    @endauth
                    {{-- DROPDOWN CATEGORIE --}}
                    <li class="nav-item dropdown mx-1">
                        <a class="nav-link fw-bold  @if (Route::currentRouteName() == 'announcement.index') active @endif dropdown-toggle"
                            href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @if (Route::currentRouteName() == 'announcement.index')
                                {{ __("ui.$categoryName") }}
                            @else
                                {{ __('ui.Categorie') }}
                            @endif
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($categories as $category)
                                <li><a class="dropdown-item fw-bold "
                                        href="{{ route('announcement.index', [$category, 'categoryName' => $category->name]) }}">{{ __("ui.$category->name") }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @guest
                        {{-- REGISTRATI --}}
                        <li class="nav-item mx-1">
                            <a class="nav-link fw-bold  @if (Route::currentRouteName() == 'register') active @endif"
                                href="{{ route('register') }}">{{ __('ui.Registrati') }}</a>
                        </li>
                        {{-- LOG IN --}}
                        <li class="nav-item mx-1">
                            <a class="nav-link fw-bold  @if (Route::currentRouteName() == 'login') active @endif"
                                href="{{ route('login') }}">{{ __('ui.Accedi') }}</a>
                        </li>
                    @else
                        {{-- USER SECTION --}}
                        <li class="nav-item dropdown mx-1">
                            <a class="nav-link fw-bold  @if (Route::currentRouteName() == 'revisor.request' || Route::currentRouteName() == 'announcement.create') active @endif dropdown-toggle"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ __('ui.Ciao') }}, {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if (Auth::user()->is_revisor===null)
                                    <li><a class="dropdown-item fw-bold"
                                            href="{{ route('revisor.request') }}">{{ __('ui.Diventa revisore') }}</a></li>
                                @endif
                                <li><a class="dropdown-item fw-bold"
                                        href="{{ route('announcement.create') }}">{{ __('ui.Crea annuncio') }}</a>
                                </li>
                                <li>
                                    {{-- LOGOUT USER --}}
                                    <hr class="dropdown-divider">
                                <li><a class="dropdown-item fw-bold" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();document.querySelector('#logout-form').submit()">{{ __('ui.Esci') }}</a>
                                </li>
                                <form action="{{ route('logout') }}" class="d-none" id="logout-form" method="POST">
                                    @csrf
                                </form>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                {{-- DELETE USER --}}
                                <li><a class="dropdown-item fw-bold " href="{{ route('user.destroy') }}"
                                        onclick="event.preventDefault();document.querySelector('#form-destroy').submit()">{{ __('ui.Cancella il tuo profilo') }}</a>
                                </li>
                                <form action="{{ route('user.destroy') }}" id="form-destroy" method="POST" class="d-none">
                                    @csrf
                                    @method('delete')
                                </form>
                            </ul>
                        </li>
                    @endguest
                </ul>
                {{-- SEARCH ZONE --}}
                <form class="d-flex ms-0 mt-3" role="search" action="{{ route('announcement.search') }}"
                    method="GET">
                    <input class="form-control me-2 search-width searchResize" type="search"  name="query">
                    <button class="button-74 searchResize fw-bold" type="submit">{{ __('ui.Cerca') }}</button>
                </form>

                <div class="nav-item dropdown lang-item d-none d-lg-block">

                    <button class="btn" data-bs-toggle="dropdown" aria-expanded="false">
                        @if (__('ui.Articoli') == 'Articoli')
                            <img src="{{ asset('vendor/blade-flags/language-' . 'it' . '.svg') }}" alt=""
                                width="32" height="32" class="" />
                        @elseif (__('ui.Articoli') == 'Artículos')
                            <img src="{{ asset('vendor/blade-flags/language-' . 'es' . '.svg') }}" alt=""
                                width="32" height="32" class="" />
                        @elseif (__('ui.Articoli') == 'Articles')
                            <img src="{{ asset('vendor/blade-flags/language-' . 'en' . '.svg') }}" alt=""
                                width="32" height="32" class="" />
                        @endif
                    </button>
                    <ul class="dropdown-menu dropdown-custom">
                        <li class="@if (__('ui.Articoli') == 'Articles') d-none @endif"><x-_local lang="en" /></li>
                        <li class="@if (__('ui.Articoli') == 'Artículos') d-none @endif"><x-_local lang="es" /></li>
                        <li class="@if (__('ui.Articoli') == 'Articoli') d-none @endif"><x-_local lang="it" /></li>
                    </ul>
                </div>

            </div>
        </div>

    </nav>

</div>
