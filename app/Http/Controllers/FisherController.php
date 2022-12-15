<?php

namespace App\Http\Controllers;

use App\Models\Fisher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FisherController extends Controller
{
    public function verify(Fisher $fisher)
    {
        if (! $fisher->hasVerifiedEmail()) {
            $fisher->markEmailAsVerified();
        }

        return redirect('/?verified=1');
    }

    public function all()
    {
        return view('fishers.all');
        # collect()
        # Fisherr::all()
    }

    public function login()
    {
        return view('fishers.login');
    }

    public function session(Request $request)
    {
        if (Auth::guard('fisher')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            return redirect()->intended(route('fisher.dashboard'));
        }
    }

    public function sing_out()
    {
    }
}
