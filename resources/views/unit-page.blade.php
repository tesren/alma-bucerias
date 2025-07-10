<div class="container">
    {{-- In work, do what you enjoy. --}}

    @section('titles')
        <title>{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías</title>
        <meta name="description" content="{{__('Descubre el Condominio :name en ALMA Bucerías, ubicado en el piso :floor con :bedrooms recámaras y :area m² de espacio total. Disfruta de una vida costera, diseño moderno y acceso a exclusivas amenidades como alberca y área BBQ. ¡Tu hogar ideal en Bucerías, Nayarit, te espera!',
            [
                'bedrooms' => $unit->unitType->bedrooms,
                'area' => $unit->const_total,
                'name' => $unit->name,
                'floor' => $unit->floor
            ])}}">
    @endsection


    <div class="fs-5 fw-light mt-4 mt-lg-5">{{__('Información de la unidad')}}</div>
    <hr class="green-hr">

    @php
        $unit_type_imgs = $unit->unitType->getMedia('gallery');
        $unit_imgs = $unit->getMedia('gallery');

        $status_class = $unit->status;

        switch ($status_class) {
            case 'Disponible':
                $status_class = 'text-success';
                break;

            case 'Apartada':
                $status_class = 'text-warning';
                break;

            case 'Vendida':
                $status_class = 'text-danger';
                break;
            
            default:
                $status_class = 'text-success';
                break;
        }
    @endphp

    {{-- Inicio --}}
    <div class="row mb-5">

        <div class="col-12 col-lg-8 p-1">
            @isset($unit_type_imgs[0])
                <img src="{{ $unit_type_imgs[0]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" data-fancybox="gallery" class="w-100 object-fit-cover h-100">
            @endisset
        </div>

        <div class="col-12 col-lg-4 px-0">
            
            <div class="row h-100">
                <div class="col-6 col-lg-12 px-0">
                    @isset($unit_type_imgs[1])
                        <img src="{{ $unit_type_imgs[1]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" data-fancybox="gallery" class="w-100 p-1 h-100 object-fit-cover" style="max-height: 45vh;">
                    @endisset
                </div>
    
                <div class="col-6 col-lg-12 px-0">
                    @isset($unit_type_imgs[2])
                        <img src="{{ $unit_type_imgs[2]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" data-fancybox="gallery" class="w-100 p-1 h-100 object-fit-cover" style="max-height: 45vh;">
                    @endisset
                </div>
            </div>

        </div>
    </div>

    @if ( count($unit_type_imgs) > 3)
    
        @for ($i=3; $i<count($unit_type_imgs); $i++ )
            <img src="{{ $unit_type_imgs[$i]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" data-fancybox="gallery" class="d-none">
        @endfor

    @endif


    <div class="row justify-content-between">

        {{-- Detalles del condominio --}}
        <div class="col-12 col-lg-8">
    
            <h1>
                {{__('Condominio')}} {{$unit->name}}

                @auth
                    @if ( !null == $unit->users()->wherePivot('unit_id', $unit->id)->wherePivot('user_id', auth()->user()->id)->first() )

                        <button wire:click="removeUnit({{$unit->id}})" class="btn btn-link link-danger fs-3" title="{{__('Quitar de Favoritos')}}">
                            <i class="fa-solid fa-heart"></i>
                        </button>

                    @else

                        <button wire:click="saveUnit({{$unit->id}})" class="btn btn-link link-danger fs-3"  title="{{__('Agregar a Favoritos')}}">
                            <i class="fa-regular fa-heart"></i>
                        </button>

                    @endif
                @endauth

            </h1>

            <p class="text-secondary fs-5 fw-light">{{__('Un sueño hecho realidad. Vive en esta increible unidad adecuada perfectamente para tu familia')}}</p>

            <div class="row justify-content-between mt-5">

                <div class="col-12 col-lg-5 px-0 order-2 order-lg-1">
                    <h2>
                        <div class="fs-4">{{__('Precio')}}:</div>
                        <div>${{ number_format($unit->price) }} <span class="fs-5">{{$unit->currency}}</span></div>
                    </h2>

                    <div class="border-2 border-start border-success px-1 fs-5 mt-4 mb-5">
                        <span>{{__('Estatus')}}:</span>
                        <span class="{{$status_class}}">{{$unit->status}}</span>
                    </div>

                    <h2 class="fs-3">{{__('Más características')}}</h2>

                    <table class="table mb-5 mb-lg-0">

                        <tbody class="fs-5">

                            <tr>
                                <td class="text-secondary">{{__('Tipo')}}</td>
                                <td class="text-end text-green">{{$unit->unitType->name}}</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">{{__('Nivel')}}</td>
                                <td class="text-end text-green">
                                    @if ($unit->floor == 0)
                                        {{__('PB')}}
                                    @else
                                        {{ $unit->floor }}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="text-secondary">{{__('Vista')}}</td>
                                <td class="text-end text-green">
                                    @if ( app()->getLocale() == 'en' )
                                        {{$unit->tower->description_en}}
                                    @else
                                        {{$unit->tower->description_es}}
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="text-secondary">{{__('Precio por M²')}}</td>
                                <td class="text-end text-green">${{ number_format($unit->price / $unit->const_total) }} {{$unit->currency}}</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="col-12 col-lg-6 px-0 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="d-flex text-center justify-content-center">

                        <div class="px-4">
                            <div class="fs-2">{{$unit->unitType->bedrooms}}</div>
                            <div class="fs-5">{{__('Recámaras')}}</div>
                        </div>
                        <div class="border-1 border-success border-start border-end px-4">
                            <div class="fs-2">{{$unit->unitType->bathrooms}}</div>
                            <div class="fs-5">{{__('Baños')}}</div>
                        </div>
                        <div class="px-4">
                            <div class="fs-2">{{$unit->const_total}}</div>
                            <div class="fs-5">{{__('M² Total')}}</div>
                        </div>

                    </div>
                </div>

            </div>
    
        </div>


        {{-- Sección de contacto --}}
        <div class="col-12 col-lg-4 px-4">
            <livewire:contact-form />

            <div class="row mt-4">

                <div class="col-3">
                    <img src="{{asset('img/domus-round.webp')}}" alt="Domus Vallarta" class="w-100">
                </div>

                <div class="col-9 align-self-center">
                    <div class="fs-3">Domus Vallarta</div>
                    <a href="tel:+523322005523" class="link-secondary fs-5">
                        +52 332 200 5523
                    </a>
                </div>
            </div>
        </div>

        {{-- Planes de pago --}}
        <div class="row mt-6 justify-content-between px-0">

            {{-- Planes de pago --}}
            @if( $unit->status != 'Vendida' )
                <div class="col-12 col-lg-7 order-2 order-lg-1 px-0">
    
                    
                    <div class="px-0 shadow">
    
                        <h3 class="fs-4 mb-3 text-center d-block d-lg-none pt-4">{{__('Planes de Pago')}}</h3>
    
                        <ul class="position-relative nav nav-pills px-3 px-lg-5 pb-4 pt-0 pt-lg-4 justify-content-center justify-content-lg-start z-3" id="pills-tab" role="tablist">
            
                            <li class="me-3 d-none d-lg-flex">
                                <h3 class="fs-4 mb-0 align-self-center">{{__('Planes de Pago')}}</h3>
                            </li>
            
                            @php
                                $i = 0;
                            @endphp
            
                            @foreach ($unit->paymentPlans as $plan)
            
                                <li class="nav-item me-1" role="presentation">
                                    <button class="nav-link rounded-pill @if($i==0) active @endif" id="pills-{{$plan->id}}-tab" data-bs-toggle="pill" data-bs-target="#pills-plan-{{$plan->id}}" type="button" role="tab">
                                        @if (app()->getLocale() == 'en')
                                            {{$plan->name_en}}
                                        @else
                                            {{$plan->name}}
                                        @endif
                                    </button>
                                </li>
            
                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            
                        </ul>
            
                        <div class="tab-content position-relative" id="pills-tabContent">
        
                            @php $i = 0; @endphp
                            @foreach ($unit->paymentPlans as $plan)
            
                                @php
                                    if($plan->discount > 0){
                                        $final_price = $unit->price * ( (100 - $plan->discount)/100 );
                                    }else{
                                        $final_price = $unit->price;
                                    }
                                @endphp 
            
                                <div class="tab-pane pb-3 fade @if($i==0) show active @endif" id="pills-plan-{{$plan->id}}" role="tabpanel" tabindex="0">
                                    
                                    <div class="py-4 bg-green text-center">
                                        <div>{{__('Precio Final')}}</div>
                                        <div class="fs-2">${{ number_format($final_price) }} {{ $unit->currency }}</div>
                                    </div>
            
                                    @isset($plan->discount)
                                        <div class="d-flex justify-content-between my-3 px-2 px-lg-4 fw-light">
                                            <div class="fs-4">{{__('Precio de lista')}}</div>
                                            <div class="text-decoration-line-through fs-4">${{ number_format($unit->price) }} {{ $unit->currency }}</div>
                                        </div>
                                    @endisset
            
                                    @isset($plan->discount)
                                        <div class="d-flex justify-content-between mb-3 px-2 px-lg-4 fw-light">
                                            <div class="fs-4">{{__('Descuento')}} ({{$plan->discount}}%)</div>
                                            <div class="fs-4">${{ number_format( $unit->price * ($plan->discount/100) ) }} {{ $unit->currency }}</div>
                                        </div>
    
                                        <hr class="green-hr">
                                    @endisset
            
                                    @isset($plan->down_payment)
                                        <div class="d-flex justify-content-between mb-3 px-2 px-lg-4 fw-light">
                                            <div class="fs-4">
                                                {{__('Enganche')}} ({{$plan->down_payment}}%)
                                                <div class="fs-6 fw-light d-none d-lg-block">{{__('A la firma del contrato de promesa de compra-venta')}}.</div>
                                            </div>
                                            <div class="fs-4">${{ number_format( $final_price * ($plan->down_payment/100) ) }} {{ $unit->currency }}</div>
                                        </div>
                                    @endisset
            
                                    @isset($plan->second_payment)
                                        <div class="d-flex justify-content-between mb-3 px-2 px-lg-4 fw-light">
                                            <div class="fs-4">
                                                {{__('Segundo pago')}} ({{$plan->second_payment}}%)
                                                <div class="fs-6 fw-light d-none d-lg-block">{{__('Sesenta días después del enganche')}}.</div>
                                            </div>
                                            <div class="fs-4">${{ number_format( $final_price * ($plan->second_payment/100) ) }} {{ $unit->currency }}</div>
                                        </div>
                                    @endisset
                                    
                                    @isset($plan->months_percent)
                                        <div class="d-flex justify-content-between mb-3 px-2 px-lg-4 fw-light">
                                            <div class="fs-4">
                                                {{$plan->months_amount}} {{__('Mensualidades')}} ({{$plan->months_percent}}%)
                                                @if ($plan->during_const)
                                                    <div class="fs-6 fw-light d-none d-lg-block">{{$plan->months_amount}} {{__('Pagos mensuales durante la construcción')}}.</div>
                                                @endif
                                            </div>
                                            <div class="fs-4">${{ number_format( $final_price * ($plan->months_percent/100) ) }} {{ $unit->currency }}</div>
                                        </div>
                                    @endisset
            
                                    @isset($plan->closing_payment)
                                        <div class="d-flex justify-content-between px-2 px-lg-4 fw-light">
                                            <div class="fs-4">
                                                {{__('Pago Final')}} ({{$plan->closing_payment}}%)
                                                <div class="fs-6 fw-light d-none d-lg-block">{{__('A la entrega física de la propiedad')}}.</div>
                                            </div>
                                            <div class="fs-4">${{ number_format( $final_price * ($plan->closing_payment/100) ) }} {{ $unit->currency }}</div>
                                        </div>
                                    @endisset
            
                                </div>
            
                                @php $i++; @endphp
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="mt-2">
                        <ul class="fs-6 fw-light">
                            <li>
                                {{__('El contrato de promesa de compra-venta tendrá que firmarse en un plazo máximo de diez días a partir de la firma de la solicitud de compra.')}}
                            </li>
    
                            <li>
                                {{__('En caso de no proceder con la compra de la unidad en el tiempo establecido (firma de contrato y pago de enganche), la unidad quedará disponible.')}}
                            </li>
    
                            <li>{{__('Precios, descuentos y condiciones de pago sujetos a cambios sin previo aviso.')}}</li>
                        </ul>
                    </div>
    
                </div>
            @endif
    
            {{-- Ubicacion en piso --}}
            <div class="col-12 col-lg-5 order-1 order-lg-2 mb-5 mb-lg-0 px-0 px-lg-5">
                <h4 class="fs-2 mb-3 text-center text-lg-start pt-4">{{__('Ubicación en Torre')}} {{$unit->tower->name}}</h4>
    
                <div class="position-relative mb-5">
    
                    <img src="{{ asset('media/'.$unit->tower->render_path) }}" alt="ALMA Bucerías, {{$unit->tower->name}}, Unidad {{$unit->name}}" class="w-100 shadow rounded-2" loading="lazy">
    
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" class="position-absolute start-0 top-0" viewBox="{{$unit->tower->viewbox}}">
                        
                        {{-- unidad marcada --}}
                        @isset($unit->shape->form_type)
                            @if ($unit->shape->form_type == 'rect')
                                <rect class="marked-unit" x="{{$unit->shape->rect_x ?? '0'}}" y="{{$unit->shape->rect_y ?? '0'}}" width="{{$unit->shape->width ?? '0'}}" height="{{$unit->shape->height ?? '0'}}"/>
                            @else
                                <polygon class="marked-unit" points="{{$unit->shape->points ?? '0,0'}}"></polygon>
                            @endif
                        @endisset
                        
                        <text x="{{$unit->shape->text_x ?? '0'}}" y="{{$unit->shape->text_y ?? '0' }}"
                            font-size="26" fill="#fff" class="fw-light">
    
                            <tspan class="fw-normal">{{$unit->name}}</tspan>
                            
                        </text>
                        
    
                    </svg>
                </div>
    
            </div>
    
        </div>
    

        {{-- Condominios similares --}}
        <h3 class="text-center mt-6 fs-1 mb-5">{{__('Condominios similares')}}</h3>

        <div class="row mb-6">
            @foreach ($more_units as $unit)

                @php
                    $imgs = $unit->unitType->getMedia('gallery');
                @endphp

                <div class="col-12 col-lg-4 mb-4">

                    <a href="{{route('unit', array_merge(['name'=>$unit->name], request()->query() ) )}}" class="card rounded-0 shadow text-decoration-none" wire:navigate>

                        @isset($imgs[0])
                            <img src="{{ $imgs[0]->getUrl('medium') }}" class="w-100 object-fit-cover" style="min-height:270px;" alt="{{__('Condominio')}} {{$unit->name}} ALMA Bucerías">
                        @endisset

                        <div class="card-body">
                            <h4 class="text-green">{{__('Condominio')}} {{$unit->name}}</h4>
                            <p class="card-text text-secondary fs-5">
                                {{$unit->unitType->bedrooms}} {{__('Recámaras')}} | {{$unit->unitType->bathrooms}} {{__('Baños')}} | {{$unit->const_total}} {{__('m²')}}
                            </p>
                            <div class="text-green fw-bold fs-4 text-center">${{number_format($unit->price)}} {{$unit->currency}}</div>
                        </div>
                    </a>

                </div>

            @endforeach 
        </div>

    </div>

    
    {{-- alertas --}}
    <div class="position-fixed bottom-0 start-0 ms-1 ms-lg-3 z-3">
        @if (session('saved'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{__(session('saved'))}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('removed'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{__(session('removed'))}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @script
        <script>
            // This Javascript will get executed every time this component is loaded onto the page...
            Fancybox.bind("[data-fancybox]", {
                
            });
        </script>
    @endscript

</div>
