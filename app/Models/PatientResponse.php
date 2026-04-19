<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientResponse extends Model
{
    protected $table = 'patient_responses';

    protected $primaryKey = 'patient_response_id';

    protected $fillable = [
        'appointment_id',
        'question_id',
        'answer',
        'notes',
    ];

    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class, 'appointment_id', 'appointment_id');
    }

    public function question(): BelongsTo
    {
        return $this->belongsTo(MedicalQuestion::class, 'question_id', 'question_id');
    }
}
