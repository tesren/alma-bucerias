<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    @section('titles')
        <title>{{__('Unidades Guardadas')}} - ALMA Bucerías</title>
        <meta name="description" content="{{__('Unidades guardadas del usuario')}}">
    @endsection 

    @php
        $user = auth()->user();
        $url = Gravatar::fallback('https://www.gravatar.com/avatar/de7554e3560de602155ce77b2eef85cb?s=300')->get($user->email, ['size'=>500]);
    @endphp


    {{-- Inicio --}}
    <div class="row position-relative mb-6 mt-0 mt-lg-3">

        <div class="col-12 col-lg-5 text-start text-lg-center align-self-center position-relative">

            <div class="position-relative z-2 d-flex justify-content-evenly" style="min-height: 110px;">
                
                <img width="160px" src="{{$url}}" alt="Profile picture" class="rounded-circle me-4 d-none d-lg-block">

                <div class="align-self-center me-4 text-start">
                    <h1 class="fs-2">{{$user->name}}</h1>
                    <div class="fs-4 fw-light text-secondary">{{$user->email}}</div>
                </div>

                <div class="align-self-center">
                    <a href="{{route('profile', request()->query() )}}" class="text-green text-decoration-none" aria-label="Config">
                        <i class="fa-solid fa-2x fa-gear"></i>
                    </a>
                </div>
                

            </div>

            <img src="{{asset('img/tower-name-bg.webp')}}" alt="ALMA Bucerías" class="w-100 d-block d-lg-none position-absolute top-0 start-0 z-1 object-fit-cover" style="height: 110px;">
        </div>

        <div class="col-12 col-lg-7 px-0 d-none d-lg-block">
            <img src="{{asset('/img/alma-bucerias-terraza-1.webp')}}" alt="ALMA Bucerías" class="w-100 object-fit-cover rounded-start-1" style="height: 250px;">
        </div>
    </div>


    {{-- Unidades --}}
    <div class="container mb-6 mt-5" style="min-height: 50vh;">

        @if ($units->isNotEmpty())

            <div class="row justify-content-center mb-4">

                <div class="col-12 col-lg-9">
                    <h2 class="fs-1">{{__('Unidades Guardadas')}}</h2>
                    <p class="fs-5">{{__('Haga clic en las tarjetas para ver más información sobre la unidad.')}}</p>        
                </div>

                <div class="col-12 col-lg-3 align-self-center">
                    <div class="text-center my-3 my-lg-0">
                        <a href="{{route('search', request()->query() )}}" class="btn btn-green rounded-0 fs-5 shadow" wire:navigate>
                            {{__('Ver todo el inventario')}}
                        </a>    
                    </div>
                </div>

            </div>

            <div class="row">
                @foreach ($units as $unit)
    
                    @php
                        $gallery = $unit->unitType->getMedia('gallery');
    
                        if($unit->status == 'Disponible'){
                            $badgeBg = 'bg-success';
                        }elseif($unit->status == 'Apartada'){
                            $badgeBg = 'bg-warning';
                        }
                        else{
                            $badgeBg = 'bg-danger';
                        }
                    @endphp
    
                    <div class="col-12 col-lg-4 mb-4 position-relative">
    
                        <div class="position-absolute z-3 top-0 end-0 m-3 d-flex justify-content-start justify-content-lg-end">
                            <div class="badge {{$badgeBg}} rounded-pill mb-2 fs-5 fw-light align-self-center">
                                {{__($unit->status)}}
                            </div>
                
                            <div class="">
                                <button wire:click="removeUnit({{$unit->id}})" class="btn btn-link link-danger fs-4" title="{{__('Quitar de Favoritos')}}">
                                    <i class="fa-solid fa-heart"></i>
                                </button>
                            </div>
                        </div>
    
                        <a href="{{ route('unit', array_merge(['name' => $unit->name, 'tower'=> $unit->tower->name ], request()->query() ) ) }}" class="card border border-1 text-decoration-none border-dark rounded-0 overflow-hidden" wire:navigate>
    
                            <div class="p-0">
                                @if ( isset($gallery[0]) )
                                    <img src="{{ $gallery[0]->getUrl('medium') }}" class="h-100 w-100 object-fit-cover" alt="Planos de la unidad {{$unit->name}} de ALMA Bucerías">
                                @else
                                    @php
                                        $rand_int = random_int( 1, 14 );
                                    @endphp
                                    <img src="{{ asset('img/interiors/dtoscana-'.$rand_int.'.webp') }}" alt="Planos de la unidad {{$unit->name}} de ALMA Bucerías" class="w-100">
                                @endif
                            </div>
    
                            
                            <div class="card-body text-green">

                                <h2 class="card-title mb-0 fs-4 fw-light">{{__('Unidad')}} {{$unit->name}}</h2>

                                <h3 class="fs-2 my-2">
                                    @if ($unit->price != 0 and $unit->status == 'Disponible')
                                        ${{ number_format($unit->price) }} {{$unit->currency}}       
                                    @endif
                                </h3>

                                <div class="text-secondary fs-5 fw-light mb-3">{{__('Torre')}} {{$unit->tower->name}}</div>

                                <div class="row justify-content-center justify-content-lg-start mb-2 fs-5 fw-light">

                                    <div class="col-6">
                                        <i class="fa-solid fa-bed"></i> {{$unit->unitType->bedrooms}} <span class="d-none d-lg-inline fw-light">{{__('Recámaras')}}</span>
                                    </div>
                    
                                    <div class="col-6">
                                        <i class="fa-solid fa-bath"></i> {{$unit->unitType->bathrooms}} <span class="d-none d-lg-inline fw-light">{{__('Baños')}}</span>
                                    </div>
                    
                                    <div class="col-12 mt-2">
                                        <i class="fa-solid fa-house-chimney"></i> {{__('Const. total')}}: {{$unit->const_total}} {{__('m²')}}
                                    </div>
                    
                                </div>

                            </div>
                            
                        </a>
                    </div>
                    
                @endforeach
            </div>

            <div class="position-fixed bottom-0 start-0 ms-1 ms-lg-3 z-3">
        
                @if (session('removed'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{__(session('removed'))}} <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            </div>

        @else

            <h1>{{__('Aún no tienes unidades guardadas')}}</h1>
            <p class="fs-4 fw-light">{{__('Visita nuestro inventario para ver todas las unidades')}}</p>
            <a href="{{route('search', request()->query() )}}" class="btn btn-green mb-6" wire:navigate>
                {{__('Ver Inventario')}}
            </a>

        @endif

    </div>

</div>
