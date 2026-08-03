<?php

namespace App\Services;

use App\AI\Agents\ConsultationAnalysisAgent;
use App\AI\Schemas\AiAnalysisResult;
use App\Models\TextBrut;

class AiService
{
    public function analyze(TextBrut $textBrut): AiAnalysisResult
    {
        $agent = ConsultationAnalysisAgent::make();

        $response = $agent->prompt(
            prompt: $textBrut->content,
        );

        return AiAnalysisResult::fromArray($response->toArray());
    }
}
