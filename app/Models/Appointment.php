<?php

namespace App\Models;

use App\Enums\AppointmentStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'patient_id',
        'appointment_date',
        'appointment_time',
        'reason',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'appointment_date' => 'date',
            'appointment_time' => 'string',
            'status' => AppointmentStatusEnum::class,
        ];
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function textBrut()
    {
        return $this->hasOne(TextBrut::class);
    }
}
