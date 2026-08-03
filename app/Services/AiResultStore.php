<?php

namespace App\Services;

use App\AI\Schemas\AiAnalysisResult;
use App\Models\TextBrut;
use Illuminate\Support\Facades\Cache;

class AiResultStore
{
    private const TTL_SECONDS = 3600;

    private function key(TextBrut $textBrut): string
    {
        return 'text_brut:'.$textBrut->id.':ai_result';
    }

    public function put(TextBrut $textBrut, AiAnalysisResult $result): void
    {
        Cache::put($this->key($textBrut), $result->toArray(), self::TTL_SECONDS);
    }

    public function get(TextBrut $textBrut): ?AiAnalysisResult
    {
        $data = Cache::get($this->key($textBrut));

        if (! is_array($data)) {
            return null;
        }

        return AiAnalysisResult::fromArray($data);
    }

    public function forget(TextBrut $textBrut): void
    {
        Cache::forget($this->key($textBrut));
    }
}
