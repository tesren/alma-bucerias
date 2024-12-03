<div class="modal fade" id="changePassModal" tabindex="-1" aria-labelledby="changePassModalLabel" aria-hidden="true">

    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <div class="modal-title fs-3" id="changePassModalLabel">{{__('Olvidé mi contraseña')}}</div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">

                <div class="mb-4 fs-5 fw-light text-green">
                    {{ __('¿Olvidaste tu contraseña? No hay problema. Solo indícanos tu dirección de correo electrónico y te enviaremos un enlace para restablecer tu contraseña.') }}
                </div>
            
                <!-- Session Status -->
                <div class="mb-4 fs-5 fw-light text-success">{{session('status')}}</div>
            
                <form wire:submit="sendPasswordResetLink">
            
                    <!-- Email Address -->
                    <div>
                        <x-input-label for="forgot_email" :value="__('Email')" />
                        <x-text-input wire:model="email" id="forgot_email" class="mt-1 form-control" type="email" name="email" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
            
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-green w-100">
                            <span wire:loading.remove>{{__('Enviar')}}</span>
                            <span wire:loading><i class="fa-solid fa-spin fa-circle-notch"></i> {{__('Enviando')}}</span>
                        </button>
                    </div>
                </form>
            
            </div>

        </div>
    </div>

</div>
