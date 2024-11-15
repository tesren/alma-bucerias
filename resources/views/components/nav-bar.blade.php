<div class="sticky-top bg-green" id="main_navbar">
    {{-- The Master doesn't talk, he acts. --}}

    <nav class="navbar navbar-expand-xxl position-relative z-2 navbar-dark">

        <div class="container-fluid px-2 px-lg-5">
            <a class="navbar-brand" href="#">
                <img width="150px" src="{{asset('/img/logo-alma.svg')}}" alt="Logo de ALMA Bucerías">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header bg-green">
                    <div class="offcanvas-title" id="offcanvasNavbarLabel">
                        <img width="150px" src="{{asset('/img/logo-alma.svg')}}" alt="Logo de ALMA Bucerías">
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                
                <div class="offcanvas-body bg-green">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">

                        <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                            <a class="nav-link @if( strpos($route, 'home') != false) active @endif" wire:navigate href="{{route('home')}}">{{__('Inicio')}}</a>
                        </li>

                        <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                            <a class="nav-link @if( strpos($route, 'lifestyle') != false) active @endif" href="{{route('lifestyle')}}" wire:navigate>{{__('Estilo de Vida')}}</a>
                        </li>

                        <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                            <a class="nav-link @if( strpos($route, 'search') != false) active @endif" href="{{route('search')}}" wire:navigate>{{__('Inventario')}}</a>
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </nav>
</div>