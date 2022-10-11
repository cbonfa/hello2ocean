<?php

namespace App\Http\Controllers;

use App\Models\Fisher;
use Illuminate\Http\Request;

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
}
