<?php

namespace App\Enums;

enum OrderPaymentStatus: string
{
    case created = 'created';
    case approved = "approved";
    case declined = "declined";
    case  reversed = 'reversed';
    case expired = 'expired';
    case processing = "processing";
}
