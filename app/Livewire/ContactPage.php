<?php

namespace App\Livewire;

use App\Mail\NewLead;
use App\Models\Message;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Spatie\Honeypot\Http\Livewire\Concerns\HoneypotData;
use Spatie\Honeypot\Http\Livewire\Concerns\UsesSpamProtection;

class ContactPage extends Component
{

    use UsesSpamProtection;

    #[Validate('required')] 
    public $full_name = '';
 
    #[Validate('required')] 
    public $contact_email = '';

    #[Validate('required')] 
    public $contact_method = '';

    public $contact_phone = '';
    public $message = '';
    public $url = '';

    public HoneypotData $extraFields;

    public function mount()
    {
        $this->extraFields = new HoneypotData();
        $this->url = request()->fullUrl();
    }


    public function render()
    {
        return view('contact-page');
    }
    

    public function save()
    {
        $this->validate(); 
        $this->protectAgainstSpam();

        $msg = new Message();

        $msg->name = $this->full_name;
        $msg->email = $this->contact_email;
        $msg->phone = $this->contact_phone;
        $msg->method = $this->contact_method;
        $msg->content = $this->message;
        $msg->url = $this->url;

        $msg->save();


        //para el webhook
        $type = "Contacto desde el sitio web de ALMA Bucerías";


        if( app()->getLocale() == 'es' ){
            $lang = 'Español';
        }
        else{
            $lang = 'Inglés';
        }

        //Envíamos webhook
        $webhookUrl = 'https://cloud.punto401.com/webhook/7bed19ac-6acc-4233-8ca5-b6d72cdbf680';

        // Datos que deseas enviar en el cuerpo de la solicitud
        $data = [
            'name' => $msg->name,
            'email' => $msg->email,
            'phone' => $msg->phone,
            'url' => $msg->url,
            'method' => $msg->method,
            'content' => $msg->content,
            'interest' => 'Condominios',
            'development' => 'ALMA Bucerías',
            'lang' => $lang,
            'type'  => $type,
            'created_at' => $msg->created_at,
        ];

        $n8nUser = env('N8N_AUTH_USER');
        $n8nPass = env('N8N_AUTH_PASS');
        
        // Enviar la solicitud POST al webhook
        $response = Http::withBasicAuth($n8nUser, $n8nPass)->post($webhookUrl, $data);


       /*  $email = Mail::to('info@domusvallarta.com')->bcc('ventas@punto401.com');
    
        //$email = Mail::to('erick@punto401.com');
        
        $email->send(new NewLead($msg)); */

        session()->flash('message', 'Mensaje enviado exitosamente');

        $this->reset();

    }
}
