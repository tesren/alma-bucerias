<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Validate;


class ForgotPassword extends Component
{
    #[Validate('required|string|email')] 
    public $email = '';

    public function sendPasswordResetLink() {
        $this->validate();

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        Session::flash('status', __($status));

        $this->redirectRoute('login', navigate: true);
    }

    public function render()
    {
        return view('components.forgot-password');
    }
}
