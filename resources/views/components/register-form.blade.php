<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title fs-3" id="registerModalLabel">{{__('Crear cuenta')}}</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <p class="fs-5 fw-light mb-0">{{__('Crea tu cuenta y obten acceso a funciones únicas y atención personalizada')}}</p>
                
                <form wire:submit="register" class="px-6 py-4">
            
                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Nombre')" />
                        <x-text-input wire:model="name" id="name" class="mt-1" type="text" name="name" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
            
                    <!-- Email Address -->
                    <div class="mt-3">
                        <x-input-label for="register_email" :value="__('Email')" />
                        <x-text-input wire:model="register_email" id="register_email" class="mt-1" type="email" name="register_email" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <!-- Phone -->
                    <div class="mt-3">
                        <x-input-label for="email" :value="__('Teléfono')" />
                        <x-text-input wire:model="phone" id="phone" class="mt-1" type="number" name="phone" required autocomplete="phone" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>
            
                    {{-- Lang --}}
                    <div class="mt-3">
                        <x-input-label for="lang" :value="__('Idioma de su preferencia')" />
                        <select wire:model="lang" class="form-select mt-1" name="lang" id="lang" required>
                            <option value="">{{__('Seleccione')}}</option>
                            <option value="es">Español</option>
                            <option value="en">English</option>
                        </select>
                        <x-input-error :messages="$errors->get('lang')" class="mt-2" />
                    </div>
            
                    <!-- Password -->
                    <div class="mt-3">
                        <x-input-label for="register_password" :value="__('Contraseña')" />
            
                        <x-text-input wire:model="password" id="register_password" class="mt-1"
                                        type="password"
                                        name="password"
                                        required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
            
                    <!-- Confirm Password -->
                    <div class="mt-3">
                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" />
            
                        <x-text-input wire:model="password_confirmation" id="password_confirmation" class="mt-1"
                                        type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
            
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
            
                    <div class="mt-4 text-center">
                        <button type="submit" class="btn btn-green w-100 mb-2">{{__('Registrar')}}</button>
                        <a class="text-green d-block" href="{{ route('login', request()->query() ) }}" wire:navigate>
                            {{ __('¿Ya tienes una cuenta?') }}
                        </a>
                    </div>
                </form>
            
            </div>

        </div>
    </div>

</div>