<?php

namespace App\Providers;

use App\Validators\DatabaseValidator;
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
            $method = ($id) ? 'PUT'    : 'POST';
            $name   = ($id) ? 'update' : 'store';

            $params = [];
            if ($id) {
                $params['id'] = $id;
            }

            return \Form::open(['method' => $method, 'url' => route($routeName.'.'.$name, $params)]);
        });

        \Form::macro('toggleCheckbox', function($name, $label, $value = 1, $checked = null, $options = [], $label_options = []) {
            $options['autocomplete'] = 'off';

            if ($checked) {
                $cls = data_get($label_options, 'class');
                $cls = ($cls) ? $cls.' active' : 'active';
                data_set($label_options, 'class', $cls);
            }

            $label_attrs = ['label'];
            foreach($label_options as $key => $option) {
                $label_attrs[] = $key.'="'.$option.'"';
            }
            $label_attr = implode(' ', $label_attrs);

            $html  = '<span class="btn-group-toggle" data-toggle="buttons">';
            $html .= '<'.$label_attr.'>';
            $html .= \Form::checkbox($name, $value, $checked, $options);
            $html .= $label;
            $html .= '</label>';
            $html .= '</span>';

            return $html;
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
