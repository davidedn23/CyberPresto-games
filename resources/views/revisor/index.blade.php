<x-layout>
    <div class="container-fluid yellowFont mt-4">
        @if (session('error'))
            <div class="messageCustom rounded-4 text-center text-black fw-bold fs-3">
                {{ session('error') }}
            </div>
        @endif
        @if (session('message'))
            <div class="messageCustom rounded-4 text-center fw-bold fs-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="dispay-1">{{ __('ui.Zona revisore') }}</h1>

                {{-- Reset button --}}
                @if (App\Models\Announcement::where('is_accepted', true)->orWhere('is_accepted', false)->count() > 0)
                    <form action="{{ route('reset') }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="button-74 ms-5 mt-3">{{ __('ui.Resetta') }}</button>
                    </form>
            </div>
            @endif
            {{-- fine button --}}
        </div>
    </div>
    @if ($announcement_to_check)
        <div class="container-fluid">
            <div class="row yellowFont">
                <div class="col-12 col-md-6 text-center">
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            {{-- <div class="carousel-item active">
                                <img src="..." class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>First slide label</h5>
                                    <p>Some representative placeholder content for the first slide.</p>
                                </div>
                            </div> --}}
                            @foreach ($announcement_to_check->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif ">

                                    <img src="{{ $image->getUrl(600, 600) }}" alt="Immagine segnaposto"
                                        class="img-fluid rounded shadow">
                                    <div class="carousel-caption yellowFont"">
                                        <div>
                                            <h5>Ratings</h5>
                                        </div>
                                        <div class="d-flex">
                                            <div class="bg-dark mx-1 px-0 px-lg-3 py-1 rounded-pill">Adult</div>
                                            <div class="text-center mx-auto  {{ $image->adult }}"></div>
                                            <div class="bg-dark mx-1 px-0 px-lg-3 py-1 rounded-pill">Violence</div>
                                            <div class="text-center mx-auto  {{ $image->violence }}"></div>
                                            <div class="bg-dark mx-1 px-0 px-lg-3 py-1 rounded-pill">Spoof</div>
                                            <div class="text-center px-0 mx-auto  {{ $image->spoof }}"></div>
                                            <div class="bg-dark mx-1 px-0 px-lg-3 py-1 rounded-pill">Racy</div>
                                            <div class="text-center mx-auto  {{ $image->racy }}"></div>
                                            <div class="bg-dark mx-1 px-0 px-lg-3 py-1 rounded-pill">Medical</div>
                                            <div class="text-center mx-auto  {{ $image->medical }}"></div>
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>
                        @if ($announcement_to_check->images->count() > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                </div>


                <div class="col-12 col-md-6 mt-4 d-flex flex-column justify-content-center align-items-center">
                    <h1>{{ __('ui.Titolo') }} : {{ $announcement_to_check->title }}</h1>
                    <h2>{{ __('ui.Sottotitolo') }} : {{ $announcement_to_check->subtitle }}</h2>
                    @if ($announcement_to_check->user_id != null)
                        <h3>{{ __('ui.Autore') }} : {{ $announcement_to_check->user->name }}</h3>
                    @endif
                    <h4>{{ __('ui.Prezzo') }} {{ $announcement_to_check->price }} €</h4>
                    <h4> {{ __('ui.' . $announcement_to_check->category->name) }}</h4>
                    <p>{{ $announcement_to_check->body }}</p>
                    <div class="d-flex pb-4 justify-content-evenly">
                        <form action="{{ route('accept', ['announcement' => $announcement_to_check]) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button-74 mx-5 mt-4">{{ __('ui.Approva') }}</button>
                        </form>
                        <form action="{{ route('reject', ['announcement' => $announcement_to_check]) }}"
                            method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="button-74 mx-5 mt-4">{{ __('ui.Rifiuta') }}</button>
                        </form>
                    </div>
                </div>


            </div>
        @else
            <div class="row h-100 justify-content-center align-items-center text-center">
                <div class="col-12">
                    <h2>{{ __('ui.Nessun articolo da revisionare') }}</h2>
                    <a class="button-74" href="{{ route('home') }}">{{ __('ui.Torna alla Homepage') }}</a>
                </div>
            </div>
    @endif
    </div>

    {{-- @if ($announcement_to_check)
            <div class="row justify-content-center pt-5">
                <div class="col-12 col-md-8">
                    <div class="row justify-content-center">
                        @foreach ($announcement_to_check->images as $key => $image)
                            <div class="col-md-4 text-center mb-4">
                                <img src="{{ $image->getUrl(600, 600) }}" alt="Immagine segnaposto"
                                    class="img-fluid rounded shadow">
                            </div>
                            <div class="col-md-8 ps-3">
                                
                            </div>
                        @endforeach
                    </div>
                </div>
            </div> --}}


</x-layout>
