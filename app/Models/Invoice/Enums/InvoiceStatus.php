<?php

namespace App\Models\Invoice\Enums;

use App\Models\EnumToArrayTrait;

enum InvoiceStatus: string
{
    use EnumToArrayTrait;

    case BILLED = 'B';

    case PAID = 'P';

    case VOID = 'V';
}
