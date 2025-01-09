<?php

namespace App\Models;

use App\Traits\HasActiveScope;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkUnit active()
 * @property string $start
 * @property string $end
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereEnd($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|WorkShift whereStart($value)
 * @mixin \Eloquent
 */
class WorkShift extends Model
{
    protected $fillable = [
        'name',
        'start',
        'end'
    ];
}
