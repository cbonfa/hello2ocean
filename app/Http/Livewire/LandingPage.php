<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class LandingPage extends Component
{
    public $email;

    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email',
    ];

    public function subscribe() 
    {
        # \Log::debug($this->email);
        $this->validate();

        DB::transaction(function() {
            $subscribe = Subscriber::create([
                'email' => $this->email,
            ]);
            $notification = new VerifyEmail;
            $notification->createUrlUsing(function($notifiable) {
                return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(90),
                    [
                            'subscriber' => $notifiable->getKey()
                    ]
                );
            });
            $subscribe->notify($notification);
        }, $deadlockRetries = 5);


        $this->reset('email');
    }
    public function render()
    {
        return view('livewire.landing-page');
    }
}
