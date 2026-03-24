<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'patient_id',
        'dentist_id',
        'scheduled_at',
        'status',
    ];
}
