<?php

namespace App\Models;

/**
 * App\Models\HakoType
 *
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Hako[] $hakos
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HakoType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HakoType whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HakoType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HakoType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\HakoType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class HakoType extends Model {

    public function hakos() {
        return $this->hasMany('App\Models\Hako');
    }

}
