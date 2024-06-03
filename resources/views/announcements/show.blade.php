<x-layout>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 text-center">
                <h1 class="dispay-2 mt-3">{{__("ui.Dettaglio dell'annuncio :")}} {{ $announcement->title }}</h1>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 h-75">
                {{-- CAROUSEL IMG --}}
                @if ($announcement->images->count() > 0)
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            
                            @foreach ($announcement->images as $key => $image)
                                <div class="carousel-item @if ($loop->first) active @endif ">
                                    <img src="{{ Storage::url($image->path) }}"
                                        alt="Immagine {{ $key + 1 }} dell'annuncio {{ $announcement->title }}"
                                        class="d-block w-100 rounded shadow">
                                </div>
                            @endforeach
                        </div>
                        @if ($announcement->images->count() > 1)
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
                @else
                    <img src="{{ Storage::url($announcement->img) }}" class="img-fluid" alt="...">
                @endif
            </div>
            {{-- FINE CAROUSEL IMG --}}
            {{-- <img src="{{ Storage::url($announcement->img) }}" class="img-fluid" alt="..."> --}}
            <div class="col-12 col-md-6 mt-5 align-content-center yellowFont p-0">
                <h2>{{ $announcement->title }}</h2>
                <h5>{{ $announcement->subtitle }}</h5>
                <p>{{ $announcement->body }}</p>
                <p>{{ $announcement->price }} $</p>
                <p>{{__("ui.".$announcement->category->name)}}</p>
            </div>
        </div>
    </div>
</x-layout>
