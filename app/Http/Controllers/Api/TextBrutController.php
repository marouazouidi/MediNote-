<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TextBrut;
use App\Http\Requests\StoreTextBrutRequest;
use App\Http\Requests\UpdateTextBrutRequest;
use App\Http\Resources\TextBrutResource;
use App\Services\TextBrutService;

class TextBrutController extends Controller
{
    public function __construct(
        protected TextBrutService $textBrutService
    ) {}

    public function store(StoreTextBrutRequest $request)
    {
        $textBrut = $this->textBrutService->store($request->validated());

        return (new TextBrutResource($textBrut))
           ->response()
           ->setStatusCode(201);
    }

    public function show(TextBrut $textBrut)
    {
        return new TextBrutResource(
            $this->textBrutService->show($textBrut)
        );
    }

    public function update(UpdateTextBrutRequest $request, TextBrut $textBrut)
    {
        $textBrut = $this->textBrutService->update($textBrut, $request->validated());

        return new TextBrutResource($textBrut);
    }
}
