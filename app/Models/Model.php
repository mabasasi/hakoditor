<?php
/**
 * Created by PhpStorm.
 * User: mabasasi
 * Date: 2018/02/26
 * Time: 23:31
 */

namespace App\Models;


use App\Libraries\ModelTrait\RelationTrait;
use App\Libraries\ModelTrait\SearchQueryTrait;
use App\Libraries\ModelTrait\SelectBoxArrayTrait;
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestDate($requestName, $startSchemeNames, $endSchemeNames)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestLike($requestName, $schemeNames, $isStrict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestOrderBy($key, $requestName = 'order')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestShowTrashed($requestName = 'trashed', $trueValue = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestWhere($requestName, $schemeNames, $isStrict = false, $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifWhere($value, $schemeNames, $operator = '=', $isMultiMode = false, $isStrict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model requestPaginate($requestName = 'paginate', $default = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model selectPluck($hasNone = false, $closure = null)
 */
class Model extends \Illuminate\Database\Eloquent\Model {
    use RelationTrait;
    use SearchQueryTrait;
    use SelectBoxArrayTrait;
    use SoftDeletes;
}