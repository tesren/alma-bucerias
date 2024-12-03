<div>
    {{-- A good traveler has no fixed plans and is not intent upon arriving. --}}

    @section('titles')
        <title>{{__('Inicia sesión')}} - ALMA Bucerías</title>
        <meta name="description" content="{{__('Inicia sesión o crea una cuenta en ALMA Bucerías, para acceder a funciones exclusivas y recibir atención personalizada. Al registrarte, podrás guardar tus propiedades favoritas, recibir actualizaciones de disponibilidad y obtener asesoría directa sobre nuestros condominios de lujo en la Riviera Nayarit.')}}">
    @endsection


    <div class="container mb-6 mt-6">
        <div class="row justify-content-center shadow">
    
            <div class="col-12 col-lg-6 mb-4 mb-lg-0 px-0">
                <img src="{{asset('/img/alma-bucerias-lobby.webp')}}" alt="ALMA Bucerías" class="w-100 rounded-0 login-img">
            </div>
    
            <div class="col-12 col-lg-6 align-self-center px-3 px-lg-5">
    
                <h1>{{__('Inicia sesión')}}</h1>
                <p class="fs-5 fw-light">{{__('Llena los campos para ingresar a tu cuenta')}}</p>
    
                <form wire:submit="login" id="login_form">
    
                    <label for="email">{{__('Correo electrónico')}}</label>
                    <input type="email" wire:model="email" name="email" id="email" class="form-control" required>
                    <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
    
                    <label for="password" class="mt-3">{{__('Contraseña')}}</label>
                    <input type="password" wire:model="password" name="password" id="password" class="form-control mb-2" required>
    
                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" wire:model="remember">
                        <label class="form-check-label" for="remember">
                            {{__('Recordarme')}}
                        </label>
                    </div>
    
                    <button type="submit" class="btn btn-green w-100 rounded-0">
                        <span wire:loading.remove>{{__('Ingresar')}}</span>
                        <span wire:loading><i class="fa-solid fa-spin fa-spinner"></i> {{__('Cargando')}}</span>
                    </button>
                </form>
    
                <div class="text-center d-flex justify-content-center">
                    <button type="button" class="btn btn-link text-green" data-bs-toggle="modal" data-bs-target="#registerModal">{{__('Crear una cuenta')}}</button>
    
                    <button type="button" class="btn btn-link text-green" data-bs-toggle="modal" data-bs-target="#changePassModal">{{__('¿Olvidaste tu contraseña?')}}</button>
                </div>
    
            </div>
    
        </div>
    </div>

    <livewire:forgot-password>

</div>