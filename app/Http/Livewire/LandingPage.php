<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Fisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;

class LandingPage extends Component
{
    public $email;
    public $showFisher = false;
    public $showSuccess = false;

    protected $rules = [
        'email' => 'required|email:filter|unique:fishers,email',
    ];

    public function mount(Request $request)
    {
        if($request->has('verified') && $request->verified == 1) {
            $this->showSuccess = true;
        }
    }

    public function subscribe() 
    {
        # \Log::debug($this->email);
        $this->validate();

        DB::transaction(function() {
            $fisher = Fisher::create([
                'email' => $this->email,
            ]);
            $notification = new VerifyEmail;
            $notification->createUrlUsing(function($notifiable) {
                return URL::temporarySignedRoute(
                    'fishers.verify',
                    now()->addMinutes(90),
                    [
                            'fisher' => $notifiable->getKey()
                    ]
                );
            });
            $fisher->notify($notification);
        }, $deadlockRetries = 5);


        $this->reset('email');
        $this->showFisher = false;
        $this->showSuccess = true;
    }
    public function render()
    {
        return view('livewire.landing-page');
    }
}
