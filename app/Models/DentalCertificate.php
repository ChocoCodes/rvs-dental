<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentalCertificate extends Model
{
    protected $table = 'dental_certificates';

    protected $fillable = [
        'appointment_id',
        'recommendations',
        'issued_at'
    ];
}
