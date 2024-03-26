<?php

namespace App\Constants;

use Illuminate\Http\JsonResponse;

class Status
{

    const ENABLE  = 1;
    const DISABLE = 0;

    const ACTIVE  = 1;
    const INACTIVE = 0;

    const PUBLISH  = 1;
    const ARCHIVE = 0;

    const YES = 1;
    const NO  = 0;

    const PAYMENT_INITIATE = 0;
    const PAYMENT_SUCCESS  = 1;
    const PAYMENT_PENDING  = 2;
    const PAYMENT_REJECT   = 3;

    const PRIORITY_LOW    = 1;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH   = 3;

    const USER_VERIFIED = 1;
    const USER_BAN    = 2;
    const USER_UNVERIFIED = 0;

    const PENDING       = 0;
    const ACCEPTED      = 1;
    const COMPLETED     = 2;
    const CANCELLED     = 3;
}