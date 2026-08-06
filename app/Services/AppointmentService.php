<?php

namespace App\Services;

use App\Models\Appointment;

class AppointmentService
{
    public function index(array $filters = [])
    {
        $query = Appointment::with('patient')
            ->whereHas('patient', function ($q) {
                $q->where('user_id', auth()->id());
            });

        if (! empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (! empty($filters['date_from'])) {
            $query->whereDate('appointment_date', '>=', $filters['date_from']);
        }

        if (! empty($filters['date_to'])) {
            $query->whereDate('appointment_date', '<=', $filters['date_to']);
        }

        return $query->latest()->paginate(15);
    }

    public function store(array $data): Appointment
    {
        return Appointment::create($data);
    }

    public function show(Appointment $appointment): Appointment
    {
        return $appointment->load('patient');
    }

    public function update(Appointment $appointment, array $data): Appointment
    {
        $appointment->update($data);

        return $appointment;
    }

    public function destroy(Appointment $appointment): bool
    {
        return $appointment->delete();
    }
}
