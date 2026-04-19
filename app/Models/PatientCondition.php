<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientCondition extends Model
{
    protected $table = 'patient_conditions';

    protected $primaryKey = 'patient_condition_id';

    protected $fillable = [
        'appointment_id',
        'condition_id',
        'notes',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }

    public function condition(): BelongsTo
    {
        return $this->belongsTo(MedicalCondition::class, 'condition_id', 'id');
    }
}
