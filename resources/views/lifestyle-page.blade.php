<div>
    {{-- Success is as dangerous as failure. --}}
    @section('titles')
        <title>ALMA Bucerías - {{__('Estilo de vida')}}</title>
        <meta name="description" content="{{__('Descubre el estilo de vida único de Bucerías, Nayarit, donde la tranquilidad de la playa se combina con la belleza natural y una vibrante comunidad. Vive cada día como vacaciones al adquirir un condominio en ALMA Bucerías, a solo 150 metros del mar. ¡Enamórate del estilo de vida costero!')}}">
    @endsection

    <div class="row justify-content-center justify-content-lg-start mb-6 bg-green px-0 pb-5 pb-lg-0">

        <div class="col-12 col-lg-7 px-0 position-relative">
            <img src="{{asset('/img/bucerias-portrait.webp')}}" alt="Estilo de vida en ALMA Bucerías" class="w-100 object-fit-cover" style="max-height: 91vh;">

            <div class="position-absolute start-0 bottom-0 mb-5 py-4 px-5 text-white bg-green d-none d-lg-block">
                <h2>Bucerías</h2>
                <p class="fs-5 fw-light">{{__('En Bucerías, la serenidad y la belleza')}} <br> {{__('natural están presentes en cada rincón.')}}</p>
            </div>
        </div>

        <div class="col-12 col-lg-4 align-self-center text-white px-3 px-lg-5 mt-5 mt-lg-0">
            <h1 class="mb-4">{{__('El Paraíso Costero que Combina Tranquilidad y Encanto')}}</h1>
            <p class="mb-4 fs-5 fw-light">{{__('Bucerías es una joya costera ubicada en el municipio de Bahía de Banderas, entre los encantadores poblados de La Cruz de Huanacaxtle y Nuevo Vallarta. Este paraíso te invita a descubrir un mar tranquilo de aguas cristalinas y poco oleaje, perfecto para relajarte bajo el cálido sol mexicano. Su playa de arena dorada se extiende a lo largo de la costa, ofreciéndote un lugar idílico para tomar el sol, nadar o dar un relajante paseo al atardecer.')}}</p>

            <p class="fs-5 fw-light d-none d-lg-block">{{__('Sumérgete en su ambiente de pueblo encantador y auténtico, donde la cultura local y la hospitalidad de su gente te harán sentir como en casa. Explora sus calles adoquinadas llenas de tiendas coloridas, galerías de arte y restaurantes de auténtica comida mexicana.')}}</p>
            
            <div class="text-center text-lg-start mt-5">
                <a href="{{route('tower', ['name'=>'A'] )}}" wire:navigate class="btn btn-light px-4 fs-5 py-3 rounded-0 shadow">
                    {{__('Mira nuestro inventario')}}
                </a>
            </div>

        </div>

    </div>

    <div class="row justify-content-evenly mb-6">

        <div class="col-12 col-lg-5 align-self-center">
            <h2 class="mb-5">{{__('Ventajas de Vivir en Bucerías:')}}</h2>

            <ol class="fs-5 fw-light ps-3">

                <li class="mb-3">
                    <strong>{{__('Playas Hermosas')}}:</strong>
                    {{__('Bucerías cuenta con algunas de las playas más impresionantes de la región, con arenas suaves y aguas cristalinas ideales para relajarse y disfrutar del sol.')}}
                </li>

                <img src="{{asset('/img/friendly-bucerias.webp')}}" alt="Comunidad amigable en Bucerías" class="d-block d-lg-none w-100 shadow rounded-1 object-fit-cover mb-2" style="height: 250px;">
                <li class="mb-3">
                    <strong>{{__('Comunidad Amigable')}}:</strong>
                    {{__('Los residentes de Bucerías son conocidos por su hospitalidad y calidez, creando un ambiente acogedor para todos.')}}
                </li>

                <li class="mb-3">
                    <strong>{{__('Naturaleza y Montañas')}}:</strong>
                    {{__('Rodeado de montañas y naturaleza exuberante, Bucerías ofrece un entorno perfecto para los amantes del aire libre y las actividades al aire libre.')}}
                </li>

                <li class="mb-3">
                    <strong>{{__('Gastronomía y Restaurantes')}}:</strong>
                    {{__('La oferta culinaria en Bucerías es diversa y deliciosa, con una gran variedad de restaurantes que ofrecen desde mariscos frescos hasta cocina internacional.')}}
                </li>

                <img src="{{asset('/img/bucerias-home.webp')}}" alt="Artesanías coloridas en Bucerías" class="d-block d-lg-none w-100 shadow rounded-1 object-fit-cover mb-2" style="height: 250px;">
                <li class="mb-3">
                    <strong>{{__('Artesanías Coloridas')}}:</strong>
                    {{__('El mercado de artesanías de Bucerías es un lugar vibrante donde se pueden encontrar productos locales únicos y coloridos.')}}
                </li>

                <li class="mb-3">
                    <strong>{{__('Paz y Seguridad')}}:</strong>
                    {{__('Bucerías es conocido por ser un lugar seguro y tranquilo, ideal para aquellos que buscan un estilo de vida relajado.')}}
                </li>

                <img src="{{asset('img/deportes-acuaticos.webp')}}" alt="Deportes acuaticos en Bucerías" class="d-block d-lg-none w-100 shadow rounded-1 mb-2">
                <li class="mb-3">
                    <strong>{{__('Deportes Acuáticos')}}:</strong>
                    {{__('Las aguas de Bucerías son perfectas para practicar deportes acuáticos como el surf, el paddleboard, el snorkel y la pesca.')}}
                </li>
            </ol>

        </div>

        <div class="col-12 col-lg-4 d-none d-lg-block">
            <img src="{{asset('img/lifestyle-bucerias.webp')}}" alt="Estilo de vida en ALMA Bucerías" class="w-100">
        </div>

    </div>

    {{-- Ubicación --}}
    @include('components.location')

</div>
