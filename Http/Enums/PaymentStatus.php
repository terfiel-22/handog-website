<?php

namespace Http\Enums;

class PaymentStatus extends Enums
{
    const UNPAID = "unpaid";
    const PAID = "paid";
    const FAILED = "failed";
    const REFUNDED = "refunded";
    const CANCELLED = "cancelled";
}
