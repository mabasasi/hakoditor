<?php
/**
 * Created by PhpStorm.
 * User: mabasasi
 * Date: 2018/02/26
 * Time: 23:31
 */

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends \Illuminate\Database\Eloquent\Model {
    use SoftDeletes;
}