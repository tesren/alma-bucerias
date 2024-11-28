<div>
    @section('titles')
        <title>ALMA Bucerías - {{__('Avances de Obra')}}</title>
        <meta name="description" content="{{__('Mantente al día con los avances de obra de ALMA Bucerías. Descubre el progreso mensual de la construcción a través de imágenes y videos detallados. Vive la evolución de este exclusivo proyecto de condominios a solo 150 metros de la playa en Bucerías, Nayarit.')}}">
    @endsection


    {{-- Do your work, then step back. --}}
    <div class="position-relative">
        <img src="{{asset('/img/alma-bucerias-alberca.webp')}}" alt="ALMA Bucerías" class="w-100 object-fit-cover" style="height: 25vh;">

        <div class="fondo-oscuro"></div>

        <div class="position-absolute bottom-0 start-0 row h-100 justify-content-center z-3">

            <div class="col-12 col-lg-8 px-0 position-relative text-white text-center align-self-center">
                <h1 class="fs-0 fw-light">{{__('Avances de Obra')}}</h1>
            </div>

        </div>

    </div>


    @if ( $const_updates->isNotEmpty() )
    
        <div class="row justify-content-center py-5 position-relative" style="background-image: url('{{asset('img/fondo-logo.webp')}}');">

            @foreach ($const_updates as $update)
                <div class="card rounded-0 overflow-hidden col-11 col-lg-9 col-xxl-7 mb-5 p-0 shadow">
                    
                    @php
                        $portrait = asset('media/'.$update->portrait_path);
                        $date = __(date_format($update->date, 'F')).' '.date_format($update->date, 'Y');
                        $images = $update->getMedia('gallery_construction');
                    @endphp

                    <div class="position-relative">
                        <img src="{{$portrait}}" class="w-100" alt="Avance de Obra ALMA Bucerías - {{$date}}" style="max-height: 470px; object-fit:cover;">
                        <div class="row position-absolute top-0 start-0 justify-content-center h-100">
                            <div class="col-12 text-center align-self-center">
                                
                                @if ($update->video_link)
                                    <a href="#construction-{{$update->id}}-1" class="link-light" aria-label="Ver avance de obra de {{$date}}"><i class="fa-solid fa-4x fa-play"></i></a>
                                @else
                                    <a href="#construction-{{$update->id}}-1" class="link-light text-decoration-none fs-1" aria-label="Ver avance de obra de {{$date}}"><i class="fa-regular fa-images"></i> {{count($images)}}</a>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="card-body d-flex position-relative overflow-hidden text-green">

                        <img class="me-5 align-self-center d-none d-lg-block" src="{{asset('img/logo-alma-verde.webp')}}" alt="Logo de ALMA Bucerías" width="170px">            
                        <h2 class="mb-0 lh-1 fw-light">{{$date}} <br> <span class="fs-5">{{__('Avance de Obra')}}</span> </h2>
                        
                    </div>

                    @if ($update->video_link)
                        <a href="{{$update->video_link}}" data-fancybox="construction-{{$update->id}}" class="d-none">{{__('Video de avance de obra')}} ALMA Bucerías - {{$date}}</a>
                    @endif

                    @foreach ($images as $image)
                        <img src="{{$image->getUrl('large')}}" alt="Avance de Obra ALMA Bucerías - {{$date}}" class="w-100 d-none" data-fancybox="construction-{{$update->id}}">
                    @endforeach
                      
                </div>
            @endforeach
        </div>

        {{-- $const_updates->links() --}}
        
    @endif


    @script
        <script>
            // This Javascript will get executed every time this component is loaded onto the page...
            Fancybox.bind("[data-fancybox]", {
                
            });
        </script>
    @endscript

</div>
