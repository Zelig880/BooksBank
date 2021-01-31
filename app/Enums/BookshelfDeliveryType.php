<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DropOff()
 * @method static static PickUp()
 * @method static static Any()
 */
final class BookshelfDeliveryType extends Enum
{
    const DropOff = '0';
    const PickUp = '1';
    const Any = '2';
}
