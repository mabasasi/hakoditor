<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // extend validator
        \Validator::resolver(function ($translator, $data, $rules, $messages) {
            return new DatabaseValidator($translator, $data, $rules, $messages);
        });

        \Form::macro('openResource', function(string $routeName, $id) {
            $method = ($id) ? 'POST' : 'PUT';
            $name   = ($id) ? 'store' : 'update';

            $params = [];
            if ($id) {
                $params['id'] = $id;
            }

            return \Form::open(['method' => $method, 'url' => route($routeName.'.'.$name, $params)]);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
