<?php

namespace App\Enums;

enum AppointmentStatusEnum: string
{
    case Scheduled = 'scheduled';
    case Completed = 'completed';
    case Cancelled = 'cancelled';
}
