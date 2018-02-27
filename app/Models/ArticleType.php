<?php

namespace App\Models;


/**
 * App\Models\ArticleType
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Article[] $articles
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestDate($requestName, $startSchemeNames, $endSchemeNames)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestLike($requestName, $schemeNames, $isStrict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestOrderBy($key, $requestName = 'order')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestShowTrashed($requestName = 'trashed', $trueValue = true)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifRequestWhere($requestName, $schemeNames, $isStrict = false, $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model ifWhere($value, $schemeNames, $operator = '=', $isMultiMode = false, $isStrict = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model requestPaginate($requestName = 'paginate', $default = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model selectPluck($hasNone = false, $closure = null)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ArticleType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ArticleType extends Model {

    public function articles() {
        return $this->hasMany('App\Models\Article');
    }

}
