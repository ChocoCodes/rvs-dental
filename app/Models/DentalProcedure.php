<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DentalProcedure extends Model
{
    protected $table = 'dental_procedures';

    protected $fillable = [
        'name',
        'base_price'
    ];
}
