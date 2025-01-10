<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property string $type
 * @property string|null $reason
 * @property int $employee_id
 * @property string $date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee $employee
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereReason($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absent whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Absent extends Model
{
    protected $fillable = [
        'type',
        'reason',
        'employee_id',
        'date',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
