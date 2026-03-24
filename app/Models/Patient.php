<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'patients';

    protected $fillable = [
        'full_name',
        'address',
        'sex',
        'contact_no',
        'date_of_birth',
        'occupation',
        'marital_status',
        'guardian_name',
    ];
}
