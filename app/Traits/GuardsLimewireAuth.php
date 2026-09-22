<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait GuardsLimewireAuth
{
    
    public function initializeGuardsLimewireAuth()
    {
        
        if (app()->runningInConsole() && (!app()->runningUnitTests())) {
             return;
        }
        if (isset($this->guard)) {
            abort_unless(Auth::guard($this->guard)->check(), 401);
        }
    }

}