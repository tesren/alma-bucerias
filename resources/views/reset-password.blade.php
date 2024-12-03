<div class="row justify-content-center my-6">

    @section('titles')
        <title>{{__('Cambia tu contraseña')}} - ALMA Bucerías</title>
    @endsection

    <div class="col-12 col-lg-6 col-xl-5 col-xxl-4 align-self-center">

        <h1>{{__('Cambia tu contraseña')}}</h1>
        <p>{{__('Llena el formulario para actualizar tu contraseña.')}}</p>

        <form wire:submit="resetPassword">
            <!-- Email Address -->
            <div>
                <x-input-label for="reset_email" :value="__('Email')" />
                <x-text-input wire:model="email" id="reset_email" class="form-control mt-1" type="email" name="email" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
    
            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input wire:model="password" id="password" class="form-control mt-1" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
    
            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="new_password_confirmation" :value="__('Confirm Password')" />
    
                <x-text-input wire:model="password_confirmation" id="new_password_confirmation" class="form-control mt-1"
                              type="password"
                              name="password_confirmation" required autocomplete="new-password" />
    
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
    
            <button type="submit" class="btn btn-green w-100 mt-4">
                <span wire:loading.remove>{{__('Cambiar contraseña')}}</span>
                <span wire:loading><i class="fa-solid fa-spin fa-circle-notch"></i> {{__('Cargando')}}</span>
            </button>

        </form>

    </div>

</div>