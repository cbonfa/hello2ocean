<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;

// INI createUpdateOrDelete
use Illuminate\Support\ServiceProvider;
use App\Support\Macros\CreateUpdateOrDelete;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        if($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
