<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static VeryGood()
 * @method static static Good()
 * @method static static Acceptable()
 * @method static static Poor()
 */
final class BookCondition extends Enum
{
    const VeryGood =   0;
    const Good = 1;
    const Acceptable = 2;
    const Poor = 3;
}
