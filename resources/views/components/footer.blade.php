@php
    $contact = request()->query('contact');
@endphp

<footer class="row justify-content-evenly pt-5 pb-3 bg-white">
    
    <div class="col-8 col-lg-3 mb-5 mb-lg-0">
        <img src="{{asset('/img/logo-alma-verde.webp')}}" alt="Logo de ALMA Bucerías" class="w-100">
    </div>

    <div class="col-12 col-lg-3 mb-5 mb-lg-0 text-center text-lg-start px-4 px-lg-3">
        <div class="fs-3 mb-3">{{__('Oficina de ventas')}}</div>

        <address class="fs-5 fw-light mb-3">
            <i class="fa-solid fa-location-dot"></i> Lázaro Cárdenas #84 L-2, Colonia Dorada, Bucerías, Bahía de Banderas, Nayarit, C.P. 63732
        </address>

        @if ($contact != 'no')
            <a href="https://domusvallarta.com" class="text-decoration-none link-success d-block my-4 my-lg-0">
                <div class="fs-6 mb-2">{{__('Comercializador Exclusivo')}}</div>
                <img width="250px" src="{{asset('img/domus-logo-white.svg')}}" alt="Logo de Domus Vallarta Inmobiliaria">
            </a>
        @endif

    </div>

    <div class="col-12 col-lg-3 mb-5 mb-lg-0 text-center text-lg-start">


        @if ($contact != 'no')

            @php
                $formatted_phone = preg_replace('/(\d{3})(\d{3})(\d{4})/', '$1 $2 $3', config('domus.phone_number') );
            @endphp
        
            <div class="fs-3 mb-3">{{__('Contacto')}}</div>

            <a href="mailto:info@domusvallarta.com" class="link-success fs-5 text-decoration-none d-block mb-2 fw-light">
                <i class="fa-solid fa-envelope"></i> info@domusvallarta.com
            </a>

            <a href="tel:+52{{config('domus.phone_number') }}" class="link-success fs-5 text-decoration-none d-block mb-2 fw-light">
                <i class="fa-solid fa-phone"></i> +52 {{$formatted_phone}}
            </a>

            <a href="https://www.facebook.com/DomusVallartaInmobiliaria" target="_blank" rel="noopener noreferrer" aria-label="Facebook page" class="link-success text-decoration-none fs-4 me-3">
                <i class="fa-brands fa-facebook-f"></i>
            </a>

            <a href="https://www.instagram.com/domus_vallarta" target="_blank" rel="noopener noreferrer" aria-label="Instagram page" class="link-success text-decoration-none fs-4">
                <i class="fa-brands fa-instagram"></i>
            </a>
            
        @endif
    </div>

    <div class="col-12 pt-2 px-3 text-center mt-5">
        <i class="fa-regular fa-copyright"></i> Copyright 2024 - {{date('Y')}}. {{__('Todos los derechos reservados')}} | <a href="{{ route('privacy', request()->query() )}}" wire:navigate class="link-success fw-light">{{__('Aviso de Privacidad')}}</a>
        | 
       <a href="https://punto401.com" class="link-success fw-light text-decoration-none">
           {{__('Sitio web hecho por')}} <img width="70px" src="{{asset('img/logo-p401.svg')}}" alt="Logo de Punto401 Marketing">
       </a>
    </div>

</footer>