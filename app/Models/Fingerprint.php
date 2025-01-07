<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property string $name
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Fingerprint whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Fingerprint extends Model
{
    protected $fillable = [
        'name',
        'ip',
        'port'
    ];
}
