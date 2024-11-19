<?php

namespace App\Models;

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
 * @mixin \Eloquent
 */
class WorkUnit extends Model
{
    protected $fillable = [
        'name',
        'is_active'
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean'
        ];
    }
}
