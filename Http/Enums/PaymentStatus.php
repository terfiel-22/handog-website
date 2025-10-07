<?php

namespace Http\Enums;

class PaymentStatus extends Enums
{
    const UNPAID = "unpaid";
    const PAID = "paid";
    const HALF_PAID = "half_paid";
    const CANCELLED = "cancelled";
}
