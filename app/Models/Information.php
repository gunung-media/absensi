<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Information whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Information extends Model
{
    protected $fillable = [
        'name',
        'code'
    ];
}
