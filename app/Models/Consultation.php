<?php

namespace App\Models;

use Database\Factories\ConsultationFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    /** @use HasFactory<ConsultationFactory> */
    use HasFactory;

    protected $fillable = [
        'text_brut_id',
        'chief_complaint',
        'symptoms',
        'observations',
        'diagnosis',
        'follow_up_date',
        'validated_at',
    ];

    protected function casts(): array
    {
        return [
            'symptoms' => 'array',
            'follow_up_date' => 'date',
            'validated_at' => 'datetime',
        ];
    }

    public function textBrut()
    {
        return $this->belongsTo(TextBrut::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }
}
