<div>
    {{-- In work, do what you enjoy. --}}

    @section('titles')
        <title>ALMA Bucerías - {{__('Condominios en venta Torre')}} {{$tower->name}}</title>
        <meta name="description" content="{{__('Explora el inventario de ALMA Bucerías y encuentra el condominio ideal para ti. Descubre gráficamente las unidades disponibles, desde departamentos de 2 y 3 recámaras, con vistas parciales al mar y exclusivas amenidades. ¡Elige tu nuevo hogar en Bucerías, Nayarit!')}}">    
    @endsection


    <div class="row mb-6" style="background-image: url('{{asset('/img/fondo-logo.webp')}}')">

        <div class="col-12 col-lg-5 px-0 order-2 order-lg-1">
            <div class="position-relative">
                <img src="{{ asset('media/'.$tower->render_path) }}" alt="{{__('Tower')}} {{$tower->name}} ALMA Bucerías" class="w-100">

                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="position-absolute start-0 top-0 px-0" viewBox="{{$tower->viewbox}}">
    
                    @foreach ($units as $unit)
        
                        <a wire:navigate class="text-decoration-none link-light {{ strtolower($unit->status) }}-class @if($unit->status=='Bloqueada') disabled @endif" @if($unit->status != 'Bloqueada') href="{{route('unit', array_merge(['name' => $unit->name], request()->query()) ) }}" @endif @if($unit->status=='Bloqueada') role="button" aria-disabled="true" @endif>
                            
                            @isset($unit->shape->form_type)
                                @if ($unit->shape->form_type == 'rect')
                                    <rect x="{{$unit->shape->rect_x ?? '0'}}" y="{{$unit->shape->rect_y ?? '0'}}" width="{{$unit->shape->width ?? '0'}}" height="{{$unit->shape->height ?? '0'}}"/>
                                @else
                                    <polygon class="" points="{{$unit->shape->points ?? '0,0'}}"></polygon>
                                @endif
                            @endisset
                            
                            <text x="{{$unit->shape->text_x ?? '0'}}" y="{{$unit->shape->text_y ?? '0' }}"
                                font-size="26" fill="#fff" class="fw-light">
        
                                <tspan class="fw-normal">{{$unit->name}}</tspan>
                                
                            </text>
                        </a>   
                        
                    @endforeach
    
                </svg>

            </div>
        </div>

        <div class="col-12 col-lg-7 px-0 py-5 py-lg-2 align-self-center order-1 order-lg-2">

            <div class="d-block mx-auto p-4 p-lg-5 bg-white col-11 col-lg-8">
                <h1 class="text-uppercase">{{__('Inventario')}}</h1>
                <p class="fs-5">{{__('Comprueba disponibilidad y selecciona la unidad para ti.')}}</p>

                <div class="d-flex mb-5 fs-4 fw-light">
                    <div class="me-3">
                        <i class="fa-solid text-success fa-square"></i> {{__('Disponible')}}
                    </div>
        
                    <div class="me-3">
                        <i class="fa-solid fa-square text-warning"></i> {{__('Apartada')}}
                    </div>
        
                    <div>
                        <i class="fa-solid fa-square text-danger"></i> {{__('Vendida')}}
                    </div>
                </div>

                <h2 class="fs-5 mb-3">
                    <i class="fa-solid fa-eye"></i> {{__('Selecciona la vista')}}
                </h2>

                <a href="{{route('tower', ['name'=> 'A'] )}}" wire:navigate class="btn @if($tower->name == 'A') btn-green @else btn-outline-green @endif me-2 px-5 fs-5">{{__('Torre A')}}</a>

                <a href="{{route('tower', ['name'=> 'B'] )}}" wire:navigate class="btn @if($tower->name == 'B') btn-green @else btn-outline-green @endif px-5 fs-5">{{__('Torre B')}}</a>

                <h2 class="fs-5 mt-5">
                    <i class="fa-solid fa-filter"></i> {{__('Filta las unidades')}}
                </h2>

                <form class="mb-3" wire:submit.prevent="search">
                    <div class="input-group" id="search_input_group">
                
                        <div class="form-floating mb-3 mb-lg-0">
                            <select class="form-select" id="bedrooms" wire:model.live="bedrooms" wire:change="search" aria-label="{{__('Recámaras')}}">
                                <option value="0">{{__('Cualquier cantidad')}}</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <label for="bedrooms">{{__('Recámaras')}}</label>
                        </div>
                
                        <div class="form-floating mb-3 mb-lg-0">
                            <select class="form-select" id="min_price" wire:model.live="min_price" wire:change="search" aria-label="{{__('Precio min.')}}">
                                <option value="1">{{__('Sin mínimo')}}</option>
                                @php
                                    $minPriceStart = 5000000;
                                    $maxPrice = 11000000;
                                @endphp
                                @for($price = $minPriceStart; $price <= $maxPrice; $price += 1000000)
                                    <option value="{{ $price }}">${{ number_format($price / 1000000) }}m</option>
                                @endfor
                            </select>
                            <label for="min_price">{{__('Precio min.')}}</label>
                        </div>
                
                        <div class="form-floating mb-3 mb-lg-0">
                            <select class="form-select" id="max_price" wire:model.live="max_price" wire:change="search" aria-label="{{__('Precio max.')}}">
                                <option value="9999999999">{{__('Sin máximo')}}</option>
                                @php
                                    $maxPriceStart = 6000000;
                                    $maxPrice = 12000000;
                                @endphp
                                @for($price = $maxPriceStart; $price <= $maxPrice; $price += 1000000)
                                    <option  value="{{ $price }}">${{ number_format($price / 1000000) }}m</option>
                                @endfor
                            </select>
                            <label for="max_price">{{__('Precio max.')}}</label>
                        </div>
                
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>
