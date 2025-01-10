<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $username
 * @property string|null $email
 * @property string|null $phone
 * @property string|null $dob
 * @property string|null $working_period
 * @property int|null $position_id
 * @property int|null $work_unit_id
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDob($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePositionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUsername($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkUnitId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkingPeriod($value)
 * @property-read \App\Models\Position|null $position
 * @property-read \App\Models\WorkUnit|null $workUnit
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee active()
 * @property string $type
 * @property string|null $nip
 * @property string|null $last_education
 * @property string|null $pob
 * @property string|null $kelas_jabatan
 * @property string|null $sk_tmt_jabatan
 * @property string|null $sk_tmt_golongan
 * @property string|null $nomor_karpeg
 * @property string|null $tmt_kenaikan_pangkat_selanjutnya
 * @property int|null $rank_id
 * @property int|null $placement_id
 * @property int|null $fingerprint_id
 * @property-read \App\Models\Fingerprint|null $fingerprint
 * @property-read \App\Models\Placement|null $placement
 * @property-read \App\Models\Rank|null $rank
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereFingerprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereKelasJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereLastEducation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNip($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereNomorKarpeg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePlacementId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePob($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereRankId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSkTmtGolongan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereSkTmtJabatan($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereTmtKenaikanPangkatSelanjutnya($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereType($value)
 * @property bool|null $is_field_worker
 * @property int|null $work_shift_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absence> $absences
 * @property-read int|null $absences_count
 * @property-read \App\Models\WorkShift|null $workShift
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereIsFieldWorker($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereWorkShiftId($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Absent> $absents
 * @property-read int|null $absents_count
 * @mixin \Eloquent
 */
class Employee extends Model
{
    protected $fillable = [
        'id',
        'type',
        'name',
        'nip',
        'username',
        'last_education',
        'pob',
        'dob',
        'kelas_jabatan',
        'sk_tmt_jabatan',
        'sk_tmt_golongan',
        'nomor_karpeg',
        'tmt_kenaikan_pangkat_selanjutnya',
        'position_id',
        'work_unit_id',
        'rank_id',
        'placement_id',
        'fingerprint_id',
        'is_field_worker',
        'work_shift_id',
    ];

    protected function casts(): array
    {
        return [
            'is_field_worker' => 'boolean',
        ];
    }
    public function position(): BelongsTo
    {
        return $this->belongsTo(Position::class);
    }

    public function workUnit(): BelongsTo
    {
        return $this->belongsTo(WorkUnit::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function placement(): BelongsTo
    {
        return $this->belongsTo(Placement::class);
    }

    public function fingerprint(): BelongsTo
    {
        return $this->belongsTo(Fingerprint::class);
    }

    public function workShift(): BelongsTo
    {
        return $this->belongsTo(WorkShift::class);
    }

    public function absences(): HasMany
    {
        return $this->hasMany(Absence::class);
    }

    public function absents(): HasMany
    {
        return $this->hasMany(Absent::class);
    }
}
