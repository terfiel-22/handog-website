<?php

namespace Http\Enums;

class PaymentStatus extends Enums
{
    const PENDING = "pending";
    const PAID = "paid";
    const HALF_PAID = "half_paid";
    const FAILED = "failed";
    const REFUNDED = "refunded";
    const CANCELLED = "cancelled";
}
