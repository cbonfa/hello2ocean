<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;

trait GuardsLimewireAuth
{
    
    protected function initializeGuardsLimewireAuth()
    {
        
        if (app()->runningInConsole() && (!app()->runningUnitTests())) {
             return;
        }
        if (isset($this->guard)) {
            abort_unless(Auth::guard($this->guard)->check(), 401);
        }
    }

    public function getModelVars($limeWireClass, $modelClass, $include = [], $except =[])
    {
        $limewireArray = array_intersect(app($modelClass)->getFillable(), array_keys(get_class_vars(get_class($limeWireClass))));
        $limewireArray = array_merge($limewireArray, $include);        
        $limewireArray = array_diff($limewireArray, $except);
        return $limewireArray;
    }
}