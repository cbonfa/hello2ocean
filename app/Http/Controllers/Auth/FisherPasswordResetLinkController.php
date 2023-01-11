<?php

namespace App\Http\Controllers\Auth;

use App\Models\Fisher;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\ResetPassword;

class FisherPasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     *
     * @return \Illuminate\View\View
     */

    public function broker()
    {
       return Password::broker('fishers');
    }


    public function create()
    {
        return view('auth.fisher_forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);


        DB::transaction(function() {
            $fisher = Fisher::whereEmail('fisher@gmail.com')->first();
            $notification = new ResetPassword;
            $notification->createUrlUsing(function($notifiable) {
                return URL::temporarySignedRoute(
                    'fishers.password.reset',
                    now()->addMinutes(60),
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

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );


        return $status == Password::RESET_LINK_SENT
                    ? back()->with('status', __($status))
                    : back()->withInput($request->only('email'))
                            ->withErrors(['email' => __($status)]);
    }
}
