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

    <div class="row mb-5">

        <div class="col-12 col-lg-6 p-1">
            @isset($unit_type_imgs[0])
                <img src="{{ $unit_type_imgs[0]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" class="w-100 object-fit-cover" style="min-height: 55vh;">
            @endisset
        </div>

        <div class="col-12 col-lg-6 px-0">

            <div class="row h-100">

                <div class="col-6 px-0">
                    @isset($unit_type_imgs[1])
                        <img src="{{ $unit_type_imgs[1]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" class="w-100 p-1 h-50 object-fit-cover" style="min-height: 20vh;">
                    @endisset

                    @isset($unit_type_imgs[2])
                        <img src="{{ $unit_type_imgs[2]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" class="w-100 p-1 h-50 object-fit-cover d-none d-lg-block">
                    @endisset
                </div>

                <div class="col-6 px-0">
                    @isset($unit_type_imgs[3])
                        <img src="{{ $unit_type_imgs[3]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" class="w-100 p-1 h-50 object-fit-cover"  style="min-height: 20vh;">
                    @endisset

                    @isset($unit_type_imgs[4])
                        <img src="{{ $unit_type_imgs[4]->getUrl('large') }}" alt="{{__('Condominio')}} {{$unit->name}} - ALMA Bucerías" class="w-100 p-1 h-50 object-fit-cover d-none d-lg-block">
                    @endisset
                </div>
            </div>

        </div>

    </div>

    <div class="row justify-content-between">
        <div class="col-12 col-lg-8">
    
            <h1>{{__('Condominio')}} {{$unit->name}}</h1>
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
                                <td class="text-end text-green">{{$unit->tower->description_es}}</td>
                            </tr>

                            <tr>
                                <td class="text-secondary">{{__('Precio por M²')}}</td>
                                <td class="text-end text-green">${{ number_format($unit->price / $unit->const_total) }} {{$unit->currency}}</td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <div class="col-12 col-lg-5 px-0 order-1 order-lg-2 mb-5 mb-lg-0">
                    <div class="d-flex text-center justify-content-center">

                        <div class="px-4">
                            <div class="fs-1">{{$unit->unitType->bedrooms}}</div>
                            <div class="fs-5">{{__('Recámaras')}}</div>
                        </div>
                        <div class="border-1 border-success border-start border-end px-4">
                            <div class="fs-1">{{$unit->unitType->bathrooms}}</div>
                            <div class="fs-5">{{__('Baños')}}</div>
                        </div>
                        <div class="px-4">
                            <div class="fs-1">{{$unit->const_total}}</div>
                            <div class="fs-5">{{__('M² Total')}}</div>
                        </div>

                    </div>
                </div>

            </div>
    
        </div>

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
    
        <h3 class="text-center mt-6 fs-1 mb-5">{{__('Condominios similares')}}</h3>

        <div class="row mb-6">
            @foreach ($similar_units as $unit)

                @php
                    $imgs = $unit->unitType->getMedia('gallery');
                @endphp

                <div class="col-12 col-lg-4 mb-4">

                    <a href="{{route('unit', ['name'=>$unit->name] )}}" class="card rounded-0 shadow text-decoration-none" wire:navigate>

                        <img src="{{ $imgs[0]->getUrl('medium') }}" class="w-100 object-fit-cover" style="min-height:270px;" alt="{{__('Condominio')}} {{$unit->name}} ALMA Bucerías">

                        <div class="card-body">
                            <h4 class="text-green">{{'Condominio'}} {{$unit->name}}</h4>
                            <p class="card-text text-secondary fs-5">
                                {{$unit->unitType->bedrooms}} {{__('Recámaras')}} | {{$unit->unitType->bathrooms}} {{__('Baños')}} | {{$unit->const_total}}
                            </p>
                            <div class="text-green fw-bold fs-4 text-center">${{number_format($unit->price)}} {{$unit->currency}}</div>
                        </div>
                    </a>

                </div>

            @endforeach 
        </div>

    </div>

    


</div>
