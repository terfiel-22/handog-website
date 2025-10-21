<?php

namespace Http\Enums;

class PaymentStatus extends Enums
{
    const UNPAID = "unpaid";
    const DEPOSITED = "deposited";
    const PAID = "paid";
    const FAILED = "failed";
    const REFUNDED = "refunded";
    const CANCELLED = "cancelled";
}
