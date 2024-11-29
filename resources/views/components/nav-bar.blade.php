<div class="sticky-top bg-green" id="main_navbar">
    {{-- The Master doesn't talk, he acts. --}}

    <nav class="navbar navbar-expand-xxl position-relative z-2 navbar-dark">

        <div class="container-fluid px-2 px-lg-5">
            <a class="navbar-brand" href="{{route('home', request()->query() )}}" wire:navigate>
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
                            <a class="nav-link @if( strpos($route, 'home') != false) active @endif" wire:navigate href="{{route('home', request()->query() )}}">{{__('Inicio')}}</a>
                        </li>

                        <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                            <a class="nav-link @if( strpos($route, 'lifestyle') != false) active @endif" href="{{route('lifestyle', request()->query() )}}" wire:navigate>{{__('Estilo de Vida')}}</a>
                        </li>


                        <li class="nav-item dropdown me-lg-4 mb-2 mb-lg-0">
                            <a class="nav-link dropdown-toggle @if( strpos($route, 'search') != false or strpos($route, 'tower') != false ) active @endif" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{__('Inventario')}}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{route('tower', array_merge(['name'=> 'A'], request()->query() ) )}}" wire:navigate>{{__('Gráfico')}}</a></li>
                                <li><a class="dropdown-item" href="{{route('search', request()->query() )}}" wire:navigate>{{__('Lista')}}</a></li>
                            </ul>
                        </li>

                        @if ( count($const_updates) > 0 )
                            <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                                <a class="nav-link @if( strpos($route, 'construction') != false) active @endif" href="{{route('construction', request()->query() )}}" wire:navigate>{{__('Avances de Obra')}}</a>
                            </li>
                        @endif

                        {{-- <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                            <a class="nav-link @if( strpos($route, 'about') != false) active @endif" href="{{route('about', request()->query() )}}" wire:navigate>{{__('Desarrollador')}}</a>
                        </li> --}}

                        @if ($contact != 'no')
                            <li class="nav-item me-0 me-lg-4 mb-2 mb-lg-0">
                                <a class="nav-link @if( strpos($route, 'contact') != false) active @endif" href="{{route('contact', request()->query() )}}" wire:navigate>{{__('Contacto')}}</a>
                            </li>
                        @endif

                        <li class="nav-item me-0 me-lg-4">
        
                            @if ($lang == 'en')
                                @if($route == 'en.unit')
        
                                    <a class="d-block align-self-center me-0 me-lg-3 text-red nav-link text-decoration-none" title="{{__('Cambiar idioma')}}" wire:navigate href="{{$url = route('unit', array_merge(['name'=>$unit_name], request()->query() ), true, 'es');}}" data-bs-toggle="tooltip" data-bs-title="{{__('Cambiar idioma')}}">
                                        <i class="fa-solid fa-globe"></i> <span class="d-none d-lg-inline">ES</span> <span class="d-inline d-lg-none">{{__('Cambiar idioma')}}</span>
                                    </a>

                                @elseif($route == 'en.tower')

                                    <a class="d-block align-self-center me-0 me-lg-3 text-red nav-link text-decoration-none" title="{{__('Cambiar idioma')}}" wire:navigate href="{{$url = route('tower', array_merge(['name'=>$tower], request()->query() ), true, 'es');}}" data-bs-toggle="tooltip" data-bs-title="{{__('Cambiar idioma')}}">
                                        <i class="fa-solid fa-globe"></i> <span class="d-none d-lg-inline">ES</span> <span class="d-inline d-lg-none">{{__('Cambiar idioma')}}</span>
                                    </a>

                                @else
                                    
                                    <a href="{{$url = route($route, request()->query(), true, 'es')}}" wire:navigate class="d-block align-self-center me-0 me-lg-3 text-red nav-link text-decoration-none" title="{{__('Cambiar idioma')}}" data-bs-toggle="tooltip" data-bs-title="{{__('Cambiar idioma')}}">
                                        <i class="fa-solid fa-globe"></i> <span class="d-none d-lg-inline">ES</span> <span class="d-inline d-lg-none">{{__('Cambiar idioma')}}</span>
                                    </a>
        
                                @endif
        
                            @else
                                @if($route == 'es.unit')
        
                                    <a class="d-block align-self-center me-0 me-lg-3 text-red nav-link text-decoration-none" title="{{__('Cambiar idioma')}}" wire:navigate href="{{$url = route('unit', array_merge(['name'=>$unit_name], request()->query() ), true, 'en');}}" data-bs-toggle="tooltip" data-bs-title="{{__('Cambiar idioma')}}">
                                        <i class="fa-solid fa-globe"></i> <span class="d-none d-lg-inline">EN</span> <span class="d-inline d-lg-none">{{__('Cambiar idioma')}}</span>
                                    </a>

                                @elseif($route == 'es.tower')

                                    <a class="d-block align-self-center me-0 me-lg-3 text-red nav-link text-decoration-none" title="{{__('Cambiar idioma')}}" wire:navigate href="{{$url = route('tower', array_merge(['name'=>$tower], request()->query() ), true, 'en');}}" data-bs-toggle="tooltip" data-bs-title="{{__('Cambiar idioma')}}">
                                        <i class="fa-solid fa-globe"></i> <span class="d-none d-lg-inline">EN</span> <span class="d-inline d-lg-none">{{__('Cambiar idioma')}}</span>
                                    </a>
        
                                @else
                                    <a href="{{$url = route($route, request()->query(), true, 'en')}}" wire:navigate class="d-block align-self-center me-0 me-lg-3 text-red nav-link text-decoration-none" title="{{__('Cambiar idioma')}}" data-bs-toggle="tooltip" data-bs-title="{{__('Cambiar idioma')}}">
                                        <i class="fa-solid fa-globe"></i> <span class="d-none d-lg-inline">EN</span> <span class="d-inline d-lg-none">{{__('Cambiar idioma')}}</span>
                                    </a>
                        
                                @endif
                            @endif
                        </li>

                    </ul>
                </div>

            </div>
        </div>
    </nav>
</div>