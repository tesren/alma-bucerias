<div>
    {{-- Stop trying to control. --}}

    @section('titles')
        <title>ALMA Bucerías - {{__('Preventa de condominios en zona dorada de Bucerías')}}</title>
        <meta name="description" content="">
    @endsection

    {{-- Inicio --}}
    <div class="row justify-content-evenly mt-3 mt-lg-5 mb-6">

        <div class="col-12 col-lg-4 align-self-center order-2 order-lg-1">
            <h1 class="fs-0 mb-4">{{__('¡Tu nuevo hogar en el paraíso te espera en Bucerías!')}}</h1>

            <p class="text-secondary fs-5 mb-5">{{__('Descubre nuestro emocionante proyecto de viviendas en Bucerías y sé parte de esta comunidad que valora la calidad de vida, la tranquilidad y la belleza de la costa del Pacífico mexicano.')}}</p>

            <div class="text-center text-lg-start">
                <a href="#" class="btn btn-green py-3 px-4 fs-5 mb-5">
                    {{__('Se parte de esta nueva comunidad')}}
                </a>
            </div>

            <div class="row shadow py-4">

                <div class="col-6 col-lg-4 text-center order-1 order-lg-1">
                    <div class="fs-1">39</div>
                    <div class="fs-6">{{__('Unidades habitacionales')}}</div>
                </div>

                <div class="col-12 col-lg-4 text-center order-3 order-lg-2 mt-4 mt-lg-0">
                    <div class="fs-1">6 PH</div>
                    <div class="fs-6">{{__('De 145.12m² con 3 recámaras y 3 baños')}}</div>
                </div>

                <div class="col-6 col-lg-4 text-center order-2 order-lg-3">
                    <div class="fs-1">3</div>
                    <div class="fs-6">{{__('Garden Houses')}}</div>
                </div>

            </div>

        </div>

        <div class="col-12 col-lg-5 order-1 order-lg-2 mb-3 mb-lg-0">
            <picture>
                <!-- Imagen para pantallas de escritorio -->
                <source media="(min-width: 768px)" srcset="{{asset('/img/home-alma.webp')}}">
                            
                <!-- Imagen para pantallas de teléfono -->
                <source media="(max-width: 767px)" srcset="{{asset('/img/alma-bucerias-terraza.webp')}}">

                <img src="{{asset('/img/home-alma.webp')}}" alt="{{__('ALMA Bucerías')}}" class="w-100 object-fit-cover" style="max-height: 80vh;">
            </picture>
        </div>

        <div class="col-12 text-center mt-5 order-3 d-none d-lg-block">
            <a href="#info" class="link-success">
                <i class="fa-solid fa-2x fa-bounce fa-arrow-down"></i>
            </a>
        </div>

    </div>

    {{-- Bucerías --}}
    <div class="text-center mb-5">
        <h2 class="fs-1">BUCERÍAS</h2>
        <p class="fs-5 text-secondary">{{__('En Bucerías, la serenidad y la belleza natural están presentes en cada rincón.')}}</p>
    </div>

    <div class="row justify-content-evenly mb-6">

        <div class="col-12 col-lg-5 align-self-center order-2 order-lg-1">
            <h2 class="mb-4">{{__('El Paraíso Costero que Combina Tranquilidad y Encanto')}}</h2>

            <p class="text-secondary fs-5">{{__('Bucerías es una joya costera situada en el municipio de Bahía de Banderas, entre las encantadoras localidades de La Cruz de Huanacaxtle y Nuevo Vallarta. Este paraíso te invita a descubrir un mar sereno, de aguas cristalinas y poco oleaje, perfecto para relajarte bajo el cálido sol mexicano. Su playa de arena dorada se extiende a lo largo de la costa, ofreciéndote un lugar idílico para tomar el sol, nadar o dar un relajante paseo al atardecer.')}}</p>

            <p class="text-secondary fs-5 mb-5 d-none d-lg-block">{{__('Sumérgete en su ambiente encantador y auténtico pueblito, donde la cultura local y la hospitalidad de su gente te harán sentir como en casa. Explora sus calles adoquinadas llenas de coloridas tiendas, galerías de arte y restaurantes con auténtica comida mexicana.')}}</p>
        
            <div class="text-center text-lg-start mt-4">
                <a href="#" class="btn btn-outline-green fs-5 px-4">
                    {{__('Descubre más de este paraiso natural')}}
                </a>
            </div>
        </div>

        <div class="col-12 col-lg-4 order-1 order-lg-2 mb-3 mb-lg-0">
            <img src="{{asset('img/bucerias-home.webp')}}" alt="ALMA Bucerías" class="w-100">
        </div>

    </div>

    {{-- Amenidades --}}
    <div class="text-center mb-5 px-3">
        <h3 class="fs-1 text-lightgreen">{{__('Todo lo que necesitas en un solo lugar')}}</h3>
        <p class="fs-5 text-secondary">{{__('¡Vive todas las amenidades que tenemos para ti! Una nueva aventura, en uno de los lugares con mayor desarrollo de Nayarit te espera.')}}</p>
    </div>

    <div class="row justify-content-center px-2 px-lg-5 mb-6 d-none d-lg-flex">

        <div class="col-12 col-lg-3">
            <div class="position-relative">
                <img src="{{asset('img/alma-bucerias-alberca.webp')}}" alt="ALMA Bucerías - {{__('Alberca infinita')}}" class="w-100 object-fit-cover" style="height:550px;">
    
                <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply;"></div>

                <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                    {{__('Alberca infinita')}}
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="position-relative">
                <img src="{{asset('img/alma-bucerias-lobby.webp')}}" alt="ALMA Bucerías - {{__('Lobby')}}" class="w-100 object-fit-cover" style="height:550px;">
    
                <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply; opacity:0.8;"></div>

                <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                    {{__('Lobby')}}
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="position-relative">
                <img src="{{asset('img/alma-bucerias-terraza-1.webp')}}" alt="ALMA Bucerías - {{__('Rooftop')}}" class="w-100 object-fit-cover" style="height:550px;">
    
                <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply; opacity:0.8;"></div>

                <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                    {{__('Rooftop')}}
                </div>

            </div>
        </div>

        <div class="col-12 col-lg-3">
            <div class="position-relative">
                <img src="{{asset('img/alma-bucerias-alberca-1.webp')}}" alt="ALMA Bucerías - {{__('Área BBQ')}}" class="w-100 object-fit-cover" style="height:550px;">
    
                <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply; opacity:0.8;"></div>

                <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                    {{__('Área BBQ')}}
                </div>

            </div>
        </div>

    </div>

    {{-- Amenidades en movil --}}
    <div id="carouselExample" class="carousel slide d-block d-lg-none mb-6">

        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="position-relative">
                    <img src="{{asset('img/alma-bucerias-alberca.webp')}}" alt="ALMA Bucerías - {{__('Alberca infinita')}}" class="w-100 object-fit-cover" style="height:550px;">

                    <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply;"></div>

                    <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                        {{__('Alberca infinita')}}
                    </div>

                </div>
            </div>

            <div class="carousel-item">
                <div class="position-relative">
                    <img src="{{asset('img/alma-bucerias-lobby.webp')}}" alt="ALMA Bucerías - {{__('Lobby')}}" class="w-100 object-fit-cover" style="height:550px;">
        
                    <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply; opacity:0.8;"></div>
    
                    <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                        {{__('Lobby')}}
                    </div>
    
                </div>
            </div>

            <div class="carousel-item">
                <div class="position-relative">
                    <img src="{{asset('img/alma-bucerias-terraza-1.webp')}}" alt="ALMA Bucerías - {{__('Rooftop')}}" class="w-100 object-fit-cover" style="height:550px;">
        
                    <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply; opacity:0.8;"></div>
    
                    <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                        {{__('Rooftop')}}
                    </div>
    
                </div>
            </div>

            <div class="carousel-item">
                <div class="position-relative">
                    <img src="{{asset('img/alma-bucerias-alberca-1.webp')}}" alt="ALMA Bucerías - {{__('Área BBQ')}}" class="w-100 object-fit-cover" style="height:550px;">
        
                    <div class="py-4 position-absolute bottom-0 start-0 w-100 bg-green z-1" style="mix-blend-mode:multiply; opacity:0.8;"></div>
    
                    <div class="position-absolute bottom-0 start-0 w-100 text-white text-center z-2 pb-2 fs-4 fw-light">
                        {{__('Área BBQ')}}
                    </div>
    
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

    </div>

    {{-- Master plan --}}
    <div class="bg-green py-5 mb-5 mb-lg-0 px-2">

        <div class="text-center text-white mb-5 px-3">
            <h3 class="fs-1">{{__('Modelos')}}</h3>
            <p class="fs-5">{{__('4 tipos de condominios en venta')}}</p>
        </div>

        <div class="row justify-content-evenly container bg-white py-5 px-0 px-lg-2">

            <div class="col-12 col-lg-5 mb-4 mb-lg-0">
                <img src="{{asset('img/fachada-home.webp')}}" alt="ALMA Bucerías - Fachada" class="w-100">
            </div>

            <div class="col-12 col-lg-5 align-self-center">

                <h4 class="fs-2">{{__('Inventario')}}</h4>
                <p class="text-secondary fs-5 mb-4">{{__('39 Unidades habitacionales de las cuales:')}}</p>

                <ul class="list-unstyled text-secondary fs-5 mb-5">
                    <li class="mb-3">
                        {{__('6 PH de 145.112 m² con 3 recámaras y 3 baños')}}
                    </li>

                    <li class="mb-3">
                        {{__('25 Unidades de 80.24 m² con 2 recámaras y 2 baños')}}
                    </li>

                    <li class="mb-3">
                        {{__('5 Unidades de 82.62 m² con 1 recámara más un Den y 1 baño')}}
                    </li>

                    <li class="mb-3">
                        {{__('3 GH de 152.93 m2 con 3 recámaras y 3 baños.')}}
                    </li>
                </ul>

                <p class="fs-5 text-lightgreen mb-4">
                    {{__('Desarrollado por Grupo inmobiliario de la Costa AP')}}
                </p>

                <div class="text-center text-lg-start">
                    <img width="100px" src="{{asset('/img/gicap-logo.webp')}}" alt="logo de GICAP grupo inmobiliario">
                </div>

            </div>

        </div>

    </div>

    {{-- Ubicación --}}
    @include('components.location')

</div>
