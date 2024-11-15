{{-- Ubicación --}}
<div class="position-relative d-none d-lg-block">
    <img src="{{asset('img/full-map-alma.webp')}}" alt="Ubicación de ALMA Bucerías" class="w-100">

    <div class="d-flex p-3 position-absolute top-0 end-0 bg-white shadow fs-5 mt-3 me-3 mt-lg-5 me-lg-5">
        <i class="fa-solid fs-4 fa-person-walking me-2"></i>
        <div>
            {{__('A 150m de la playa')}}
        </div>
    </div>

    <div class="p-3 position-absolute bottom-0 start-0 bg-white shadow mb-3 ms-3 mb-lg-5 ms-lg-5">
        <div class="row">
            <div class="col-12 col-lg-4 text-center">
                <div class="fs-2">{{__('Ubicación')}}</div>
                <address class="fs-6"><i class="fa-solid fa-location-dot"></i> Lázaro Cárdenas 114, Zona Dorada, Bucerías, Nayarit.</address>
            </div>

            <div class="col-12 col-lg-8 align-self-center">

                <div class="mb-3">
                    <span class="me-4"><i class="fa-regular fa-hospital"></i> {{__('Hospital Riviera Nayarit a 2 min')}}</span>
                    <span><i class="fa-solid fa-umbrella-beach"></i> {{__('Acceso a la playa a 1 min')}}</span>
                </div>

                <div>
                    <span class="me-4"><i class="fa-solid fa-cart-shopping"></i> {{__('Chedraui a 4 min')}}</span>
                    <span class="me-4"><i class="fa-solid fa-plane-departure"></i> {{__('Aeropuerto 20 min')}}</span>
                    <span><i class="fa-solid fa-utensils"></i> {{__('Sobre la zona de restaurantes')}}</span>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- Ubicación en móvil --}}
<div class="row d-block d-lg-none">
    <div class="col-12 text-center mb-4">
        <div class="fs-2">{{__('Ubicación')}}</div>
        <address class="fs-6"><i class="fa-solid fa-location-dot"></i> Lázaro Cárdenas 114, Zona Dorada, Bucerías, Nayarit.</address>
    </div>

    <div class="col-12 align-self-center mb-5">

        <ul>
            <li class="mb-2"><i class="fa-regular fa-hospital"></i> {{__('Hospital Riviera Nayarit a 2 min')}}</li>
            <li class="mb-2"><i class="fa-solid fa-umbrella-beach"></i> {{__('Acceso a la playa a 1 min')}}</li>
            <li class="mb-2"><i class="fa-solid fa-cart-shopping"></i> {{__('Chedraui a 4 min')}}</li>
            <li class="mb-2"><i class="fa-solid fa-plane-departure"></i> {{__('Aeropuerto 20 min')}}</li>
            <li class="mb-2"><i class="fa-solid fa-utensils"></i> {{__('Sobre la zona de restaurantes')}}</li>
        </ul>

    </div>
</div>

<div id="carouselLocation" class="carousel slide d-block d-lg-none">

    <div class="carousel-inner">

      <div class="carousel-item">
        <img src="{{asset('/img/map-street.webp')}}" class="d-block w-100 object-fit-contain" alt="ALMA Bucerías mapa" style="min-height: 409px;">
      </div>

      <div class="carousel-item active">
        <img src="{{asset('/img/map-satelite.webp')}}" class="d-block w-100" alt="ALMA Bucerías vista aérea">

        <div class="d-flex p-3 position-absolute top-0 end-0 bg-white shadow fs-5 mt-3 me-3 mt-lg-5 me-lg-5">
            <i class="fa-solid fs-4 fa-person-walking me-2"></i>
            <div>
                {{__('A 150m de la playa')}}
            </div>
        </div>

      </div>

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselLocation" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>

    <button class="carousel-control-next" type="button" data-bs-target="#carouselLocation" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

</div>