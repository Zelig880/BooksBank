<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Available()
 * @method static static NotAvailable()
 * @method static static AwaitingCollection()
 */
final class BookStatus extends Enum
{
    const Available = '0';
    const NotAvailable = '1';
    const AwaitingCollection = '2';
}
