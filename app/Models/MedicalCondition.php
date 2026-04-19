<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalCondition extends Model
{
    protected $table = 'medical_conditions';

    protected $fillable = ['condition_name'];

    public function patientConditions(): HasMany
    {
        return $this->hasMany(PatientCondition::class, 'condition_id', 'id');
    }
}
