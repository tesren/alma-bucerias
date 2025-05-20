<div>
    {{-- Do your work, then step back. --}}
    @section('titles')
        <title>ALMA Bucerías - {{__('Contacto')}}</title>
        <meta name="description" content="{{__('Contáctanos para más información sobre nuestros exclusivos condominios en preventa. Completa el formulario de contacto o comunícate directamente con un asesor inmobiliario. Estamos aquí para ayudarte a encontrar tu hogar ideal en Bucerías, Nayarit.')}}">    
    @endsection


    <div class="row justify-content-center pt-4 pt-lg-5 pb-5" style="background-image: url('{{asset('img/fondo-logo-new.webp')}}')">

        <div class="col-12 col-lg-8 col-xxl-4 mb-5 px-3">

            <h1 class="fs-1 text-uppercase text-white mb-1"><i class="fa-solid fa-user-group"></i> {{__('Contacto')}}</h1>
            <p class="text-white fs-5">{{__('Completa el siguiente formulario y un asesor de ventas se comuniracá contigo lo más pronto posible')}}</p>

            <div class="p-4 bg-white shadow">

                <form wire:submit="save" id="lead_form">
                                
                    <div class="row fs-5">
            
                        <div class="col-12 mb-3">
                            <label for="full_name" class="me-3 align-self-center">{{__('Nombre')}}:</label>
                            <input type="text" wire:model="full_name" id="full_name" class="form-control @error('full_name') is-invalid @enderror" required>
                        </div>
            
                        <x-honeypot/>
            
                        <div class="col-12 mb-3">
                            <label for="contact_email" class="me-3 align-self-center">{{__('Correo')}}:</label>
                            <input type="email" wire:model="contact_email" id="contact_email" class="form-control" required>
                        </div>
            
                        <div class="col-12 mb-3">
                            <label for="contact_phone" class="me-3 align-self-center">{{__('Teléfono')}}:</label>
                            <input type="tel" wire:model="contact_phone" id="contact_phone" class="form-control">
                        </div>

                        <div class="col-12">
                            <label for="contact_method">{{__('¿Cómo le gustaría ser contactado?')}}</label>
                            <select class="form-select mb-3" wire:model="contact_method" id="contact_method" required>
                                <option selected value="">{{__('Seleccione uno')}}</option>
                                <option value="Email">{{__('Email')}}</option>
                                <option value="Llamada">{{__('Llamada')}}</option>
                                <option value="WhatsApp">{{__('WhatsApp')}}</option>
                            </select>                        
                        </div>
            
                        <div class="col-12 mb-4">
                            <label for="message" class="me-3">{{__('Notas')}}:</label>
                            <textarea wire:model="message" id="message" cols="30" required class="form-control" rows="3"></textarea>
                        </div>
            
                        <input type="hidden" wire:model="url" id="url" value="{{ request()->fullUrl() }}">
            
                        <div class="col-12 text-center mb-3">
                            <button type="submit" class="btn btn-green fs-5 w-100" @if(session('message')) disabled @endif>
                                {{__('Enviar')}}
                            </button>
                        </div>
            
                    </div>
            
                </form>

                {{-- Mensaje de éxito --}}
                @if (session('message'))
                    <div class="text-white rounded-2 p-3 bg-green fw-semibold fs-5 text-center mt-3 mb-4">
                        <i class="fa-regular fa-circle-check"></i> {{__(session('message'))}}
                    </div>

                    @script
                        <script>
                            const confirmationModal = new bootstrap.Modal('#confirmationModal');
                            confirmationModal.show();
                        </script>
                    @endscript
                @endif

                <div wire:loading class="text-center fs-5 my-3 text-warning"> 
                    <i class="fa-solid fa-spin fa-spinner"></i> {{__('Enviando, por favor espere')}}
                </div>    
            </div>

        </div>

    </div>

</div>
