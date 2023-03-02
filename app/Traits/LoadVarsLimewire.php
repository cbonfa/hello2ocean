<?php

namespace App\Traits;

trait LoadVarsLimewire
{
    
    public function getModelVars($limeWireClass, $modelClass, $args = [])
    {
        $include = (isset($args['include']) ? $args['include'] : []);
        $except = (isset($args['except']) ? $args['except'] : []);
        $limewireArray = array_intersect(app($modelClass)->getFillable(), array_keys(get_class_vars(get_class($limeWireClass))));
        $limewireArray = array_merge($limewireArray, $include);
        $limewireArray = array_diff($limewireArray, $except);
        return $limewireArray;
    }
}