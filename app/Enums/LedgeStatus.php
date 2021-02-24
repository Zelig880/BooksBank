<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Initialized()
 * @method static static WaitingPickup()
 * @method static static InProgress()
 * @method static static AwaitingReturn()
 * @method static static Completed()
 */
final class LedgeStatus extends Enum
{
    const WaitingApproval = 0;
    const WaitingPickup = 1;
    const InProgress = 2;
    const AwaitingReturn = 3;
    const Completed = 4;
    const Rejected = 5;
}
