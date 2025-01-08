<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Absence extends Model
{
    protected $fillable = [
        'employee_id',
        'fingerprint_id',
        'state',
        'type',
        'timestamp',
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function fingerprint(): BelongsTo
    {
        return $this->belongsTo(Fingerprint::class);
    }
}
