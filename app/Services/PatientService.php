<?php

namespace App\Services;

use App\Models\Patient;

class PatientService
{
    public function index()
    {
        return Patient::latest()->paginate(15);
    }

    public function search(?string $term)
    {
        return Patient::search($term)->latest()->paginate(15);
    }

    public function store(array $data): Patient
    {
        $data['user_id'] ??= auth()->id();

        return Patient::create($data);
    }

    public function show(Patient $patient): Patient
    {
        return $patient;
    }

    public function update(Patient $patient, array $data): Patient
    {
        $patient->update($data);

        return $patient;
    }

    public function destroy(Patient $patient): bool
    {
        return $patient->delete();
    }
}
