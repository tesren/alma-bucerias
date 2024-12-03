<div>
    {{-- Do your work, then step back. --}}
    @section('titles')
        <title>{{__('Mi Perfil')}} - ALMA Bucerías</title>
    @endsection

    @php
        $user = auth()->user();
        $url = Gravatar::fallback('https://www.gravatar.com/avatar/de7554e3560de602155ce77b2eef85cb?s=300')->get($user->email, ['size'=>500]);
    @endphp

    {{-- Inicio --}}
    <div class="row position-relative mb-6 mt-0 mt-lg-3">

        <div class="col-12 col-lg-3 text-start text-lg-center align-self-center position-relative">

            <div class="position-relative z-2 d-flex d-lg-block justify-content-center" style="min-height: 100px;">
                <i class="fa-solid fa-user fa-4x mb-0 mb-lg-3 title-inventory align-self-center"></i>

                <div class="ms-3 ms-lg-0 align-self-center">
                    <h1 class="fs-2 title-inventory mb-0 mb-lg-2">{{__('Perfil')}}</h1>
                    <p class="fs-5 fw-light title-inventory mb-0">{{__('Comprueba tu información')}}</p>
                </div>

            </div>

            <img src="{{asset('img/tower-name-bg.webp')}}" alt="ALMA Bucerías" class="w-100 d-block d-lg-none position-absolute top-0 start-0 z-1 object-fit-cover" style="height: 100px;">
        </div>

        <div class="col-12 col-lg-9 px-0 d-none d-lg-block">
            <img src="{{asset('/img/alma-bucerias-terraza-1.webp')}}" alt="ALMA Bucerías" class="w-100 rounded-start-1 object-fit-cover" style="height: 200px;">
        </div>
    </div>

    <div class="row justify-content-center my-6" style="min-height: 53vh;">

        <div class="col-12 col-lg-9 col-xxl-7">
            <div class="row justify-content-center">

                <div class="col-8 col-lg-4 align-self-center mb-4 mb-lg-0">
                    <img src="{{$url}}" alt="Profile picture" class="w-100 rounded-circle">
                </div>
        
                <div class="col-12 col-lg-8 px-3 px-lg-4">
        
                    <h1 class="mb-1 lh-1">{{__('Mis datos')}}</h1>
                    <div class="text-secondary fs-5">{{$user->email}}</div>
                    <p class="mb-4">{{__('Aquí puedes ver y modificar tus datos personales')}}</p>
        
                    <form wire:submit="updateProfile" autocomplete="off">
        
                        <label for="user_name">{{__('Nombre')}}</label>
                        <input type="text" class="form-control mb-3 @if(session('message')) is-valid @endif" wire:model="user_name" required maxlength="255">
        
                        <label for="user_phone">{{__('Teléfono')}}</label>
                        <input type="tel" class="form-control mb-3 @if(session('message')) is-valid @endif" wire:model="user_phone" required maxlength="10">

                        <label for="user_lang">{{__('Idioma preferido')}}</label>
                        <select wire:model="user_lang" class="form-select mb-3 @if(session('message')) is-valid @endif" required>
                            <option value="">{{__('Seleccione')}}</option>
                            <option value="es">Español</option>
                            <option value="en">English</option>
                        </select>

                        <label for="user_pass">{{__('Nueva Contraseña')}}</label>
                        <div class="input-group mb-4" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" class="form-control" wire:model="user_pass" autocomplete="off">

                            <button class="btn btn-outline-green" type="button" x-on:click="show = ! show">
                                <span x-show="! show"><i class="fa-solid fa-eye"></i></span>
                                <span x-show="show"><i class="fa-solid fa-eye-slash"></i></span>

                                <span x-text="show ? '{{__('Ocultar')}}' : '{{__('Mostrar')}}'"></span>
                            </button>

                        </div>
        
                        <button type="submit" class="btn btn-green py-2 fs-5 fw-light w-100">
                            <i class="fa-solid fa-spin fa-circle-notch" wire:loading></i>
                            {{__('Guardar Cambios')}}
                        </button>

                        @if (session('message'))
                            <div class="d-block text-success fw-bold border border-success text-center p-2 mt-3">
                                <i class="fa-solid fa-check"></i> {{__( session('message') )}}
                            </div>
                        @endif
                        
                        

                    </form>
        
                </div>
            </div>
        </div>

    </div>

</div>
