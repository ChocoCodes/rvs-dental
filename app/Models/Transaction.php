<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction_ledger';

    protected $fillable = [
        'appointment_id',
        'entry_date',
        'description',
        'debit',
        'credit'
    ];
}
