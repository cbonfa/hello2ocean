<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// INI createUpdateOrDelete
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Support\Macros\CreateUpdateOrDelete;
// END createUpdateOrDelete

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // INI createUpdateOrDelete
        // Inside of the boot() method.
        HasMany::macro('createUpdateOrDelete', function (iterable $records) {
            /** @var HasMany */
            $hasMany = $this;
        
            return (new CreateUpdateOrDelete($hasMany, $records))();
        });
        // END createUpdateOrDelete
    }
}
