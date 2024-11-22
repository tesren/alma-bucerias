<div class="shadow p-4">
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}
    <div class="fs-2">{{__('Solicitar Informes')}}</div>
    <div class="text-secondary mb-4">{{__('Escribe tus datos y nosotros te enviaremos información')}}</div>

    <form wire:submit="save" id="lead_form">
                                
        <div class="row fs-5 fw-light">

            <div class="col-12 mb-3 px-0">
                <input type="text" wire:model="full_name" id="full_name" placeholder="{{__('Nombre')}}" class="form-control py-2 @error('full_name') is-invalid @enderror" required>
            </div>

            <x-honeypot/>

            <div class="col-12 mb-3 px-0">
                <input type="email" wire:model="contact_email" id="contact_email" placeholder="{{__('Correo')}}" class="form-control py-2" required>
            </div>

            <div class="col-12 mb-4 px-0">
                <input type="tel" wire:model="contact_phone" placeholder="{{__('Teléfono')}}" id="contact_phone" class="form-control py-2">
            </div>

            {{-- <div class="col-12 mb-4 px-0">
                <label for="message" class="me-3">{{__('Notas')}}:</label>
                <textarea wire:model="message" id="message" cols="30" required class="form-control" rows="3"></textarea>
            </div> --}}

            <input type="hidden" wire:model="url" id="url" value="{{ request()->fullUrl() }}">

            <div class="col-12 text-center mb-3 px-0">
                <button type="submit" class="btn btn-green fs-5 w-100" @if(session('message')) disabled @endif>
                    {{__('Enviar')}}
                </button>
            </div>

        </div>

    </form>   

</div>
