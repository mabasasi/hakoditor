<?php
/**
 * Created by PhpStorm.
 * User: mabasasi
 * Date: 2018/02/26
 * Time: 23:31
 */

namespace App\Models;


use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Model
 *
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Model onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Model withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Model withoutTrashed()
 * @mixin \Eloquent
 */
class Model extends \Illuminate\Database\Eloquent\Model {
    use SoftDeletes;
}