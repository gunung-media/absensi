<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 *
 *
 * @property int $id
 * @property int|null $employee_id
 * @property int|null $fingerprint_id
 * @property string|null $state
 * @property string|null $type
 * @property string $timestamp
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Employee|null $employee
 * @property-read \App\Models\Fingerprint|null $fingerprint
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereFingerprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Absence whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Absence extends Model
{
    protected $fillable = [
        'employee_id',
        'fingerprint_id',
        'state',
        'type',
        'timestamp',
    ];

    protected function state(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value === '1' ? 'Sidik Jari' : ($value === '5' ? 'Wajah' : ($value ?? "Tidak dikenali")),
        );
    }

    protected function type(): Attribute
    {
        return Attribute::make(
            get: function () {
                $shift = optional($this->employee->workShift);
                $start = Carbon::createFromFormat("H:i:s", $shift->start ?? "08:00:00");
                $end = Carbon::createFromFormat("H:i:s", $shift->end ?? "17:00:00");
                $timestamp = Carbon::parse($this->timestamp);
                $sameAbsences = Absence::where('employee_id', $this->employee_id)
                    ->whereDate('timestamp', $timestamp)
                    ->orderBy('timestamp', 'asc')
                    ->get();

                if ($this->id == $sameAbsences->first()->id) {
                    return $timestamp->toTimeString() > $start->toTimeString() ? "Telat" : "Masuk";
                }

                if (count($sameAbsences) >= 3 && $this->id != $sameAbsences->last()->id) {
                    return "Hadir";
                }

                if ($this->id == $sameAbsences->last()->id) {
                    return $timestamp->toTimeString() < $end->toTimeString() ? "Pulang Cepat" : "Pulang";
                }

                return "";
            }
        );
    }

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function fingerprint(): BelongsTo
    {
        return $this->belongsTo(Fingerprint::class);
    }
}
