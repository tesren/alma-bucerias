<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class ProfilePage extends Component
{
    public $user_name = '';
    public $user_phone = '';
    public $user_pass = '';
    public $user_lang = '';

    public function mount(){
        $this->user_name = auth()->user()->name;
        $this->user_phone = auth()->user()->phone;
        $this->user_lang = auth()->user()->lang;
    }

    public function updateProfile(){

        $validated = $this->validate([
            'user_name' => ['required', 'string', 'max:255'],
            'user_phone' => ['required', 'string', 'max:10'],
            'user_pass' => ['nullable', 'string', Rules\Password::defaults() ],
            'user_lang' => ['required', 'string', 'max:10'],
        ]);

        $user = User::findOrFail( auth()->user()->id );
        $user->name = $this->user_name;
        $user->phone = $this->user_phone;
        $user->lang = $this->user_lang;

        if( $this->user_pass != '' and !empty($this->user_pass) ){
            $user->password = Hash::make($this->user_pass);
        }

        $user->save();

        session()->flash('message', 'Cambios Guardados');
    }
    
    public function render()
    {
        return view('profile-page');
    }
}
