<?php

namespace App\Enums;

enum AnalysisStatusEnum: string
{
    case Pending = 'pending';
    case Analyzed = 'analyzed';
    case Validated = 'validated';
    case Failed = 'failed';
}
