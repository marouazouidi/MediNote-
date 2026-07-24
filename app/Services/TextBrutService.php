<?php

namespace App\Services;

use App\Models\TextBrut;

class TextBrutService
{
    public function store(array $data): TextBrut
    {
        $data['user_id'] ??= auth()->id();

        return TextBrut::create($data);
    }

    public function show(TextBrut $textBrut): TextBrut
    {
        return $textBrut->load(['appointment', 'doctor']);
    }

    public function update(TextBrut $textBrut, array $data): TextBrut
    {
        $textBrut->update($data);

        return $textBrut->load([
            'appointment', 'doctor'
        ]);
    }
}
