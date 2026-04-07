<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $primaryKey = 'appointment_id';

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'scheduled_at',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }

    public function dentist()
    {
        return $this->belongsTo(Dentist::class, 'dentist_id');
    }

    public function procedures()
    {
        return $this->belongsToMany(DentalProcedure::class, 'appointment_procedures', 'appointment_id', 'procedure_id')
            ->withPivot('notes', 'charged_price')
            ->withTimestamps();
    }

    public function getProcedureTypeAttribute()
    {
        return $this->procedures->first()?->name ?? 'N/A';
    }
}
