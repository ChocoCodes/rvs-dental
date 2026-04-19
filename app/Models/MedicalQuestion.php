<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MedicalQuestion extends Model
{
    protected $table = 'medical_questions';

    protected $primaryKey = 'question_id';

    protected $fillable = [
        'question',
    ];

    public function responses(): HasMany
    {
        return $this->hasMany(PatientResponse::class, 'question_id', 'question_id');
    }
}
