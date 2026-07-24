<?php

namespace App\Models;

use App\Enums\AnalysisStatusEnum;
use Illuminate\Database\Eloquent\Model;

class TextBrut extends Model
{
    protected $fillable = [
        'user_id',
        'appointment_id',
        'content',
        'analysis_status',
    ];

    protected function casts(): array
    {
        return [
            'analysis_status' => AnalysisStatusEnum::class,
        ];
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

    public function consultation()
    {
        return $this->hasOne(Consultation::class);
    }
}
