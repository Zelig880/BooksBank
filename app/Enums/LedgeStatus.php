<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static Initialized()
 * @method static static WaitingPickup()
 * @method static static InProgress()
 * @method static static ReturnRequested()
 * @method static static AwaitingReturn()
 * @method static static Completed()
 */
final class LedgeStatus extends Enum
{
    const WaitingApproval = 0;
    const WaitingPickup = 1;
    const InProgress = 2;
    const ReturnRequested = 3;
    const AwaitingReturn = 4;
    const Completed = 5;
    const Rejected = 6;
    const GivenAway = 7;
    const Cancelled = 8;
}