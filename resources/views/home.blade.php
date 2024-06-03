<x-layout>
    {{-- LOGO HEADER --}}
    <section id="home" class="container-fluid header">
        @if (session('error'))
            <div class="messageCustom rounded-4 fw-bold fs-3">
                {{ session('error') }}
            </div>
        @endif
        @if (session('message'))
            <div class="messageCustom rounded-4 text-center fw-bold fs-3">
                {{ session('message') }}
            </div>
        @endif
        <div class="row h-100 justify-content-center ">
            <div class="col-12 d-flex flex-column justify-content-center align-items-center ">
                <h1 class="glitch header-font">CyberPresto</h1>
                <h3 class="yellowFont bold">"Games for everyone!"</h3>
            </div>
        </div>
    </section>


    {{-- SAMURAI + BTN SECTION --}}
    <div class="container-fluid mt-0 backgroundVinile ">
        <div class="row justify-content-center">
            <div class="col-md-4 d-xl-block d-none p-0 " data-aos="fade-right" data-aos-duration="1500">
                <img src="/storage/img/yellowlogo.png" alt="vinile sx" class="vinileHome">
            </div>
            <div class="col-8 p-0 d-flex flex-column justify-content-center align-items-center">
                <h3 class="glitch text-center">{{ __('ui.Crea qui il tuo annuncio') }}</h3>
                <p class="fs-3 text-center">{{ __('ui.home intro') }} </p>
                <a class="button-74 mb-3 p-1 mb-lg-0"
                    href="{{ route('announcement.create') }}">{{ __('ui.Crea annuncio') }}</a>
            </div>
        </div>
    </div>

    {{-- I NOSTRI NUMERI --}}
    <section class="container-fluid my-5 p-5" id="numbersSection">
        <div class="row justify-content-between bg-darkBlue flex-column flex-md-row">
            <div class="col-12 col-lg-6">
                <img src="/storage/img/immagineincrementali.png" alt="Immagine numeri incrementali" class="img-fluid">
            </div>
            <div class="col-12 mt-5 col-lg-6 mt-lg-0">
                <h2 class="font-title display-2 glitch text-center"> {{ __('ui.Un pò di numeri') }} </h2>
                <p class="my-3 fs-4 yellowFont  text-center"><span id="firstNumber"
                        class="fw-bold fs-1 me-3 yellowFont">0</span>
                    {{ __('ui.Giochi venduti') }} </p>
                <p class="my-3 fs-4 yellowFont  text-center"><span id="secondNumber"
                        class="fw-bold fs-1 me-3 yellowFont">0</span>
                    {{ __('ui.Clienti soddisfatti') }} </p>
                <p class="my-3 fs-4 yellowFont  text-center"><span id="thirdNumber"
                        class="fw-bold fs-1 me-3 yellowFont">0</span>
                    {{ __('ui.Recensioni ricevute') }}
                </p>
            </div>
        </div>
    </section>

    {{-- ULTIMI ANNUNCI --}}
    <div class="container-fluid annunciContainer ">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center mt-5 pt-5 roboto-flex-title glitch">{{ __('ui.Ultimi Annunci') }}</h2>
            </div>
            @if (count($announcements) == 0)
                <div class="col-12 my-5 pb-5">
                    <h2 class="text-center">{{ __('ui.Nessun annuncio') }}</h2>
                </div>
            @else
                @for ($i = 0; $i < count($announcements); $i++)
                    <div class="col-12 col-md-4 d-flex justify-content-center" data-aos="fade-up"
                        data-aos-duration="3000">
                        <div class="single-card">
                            <div class="card-img">
                                <img src="{{ $announcements[$i]->images()->first()->getUrl(600, 600) }}"
                                    class="card-img-top" alt="...">
                            </div>
                            <div class="content mb-5">
                                <h2 class="card-title text-center">{{ $announcements[$i]->title }}</h2>
                                <p class="card-text">{{ __('ui.' . $announcements[$i]->category->name) }}</p>
                                @if ($announcements[$i]->user != null)
                                    <p class="card-text">{{ $announcements[$i]->user->name }}</p>
                                @endif
                                <a href="{{ route('announcement.show', ['announcement' => $announcements[$i]]) }}"
                                    class="button-74">{{ __('ui.Dettagli') }}</a>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>
</x-layout>
