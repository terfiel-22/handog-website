<?php

namespace Http\Services;

use Http\Enums\PaymentStatus;
use Http\Enums\PaymentType;

class PaymentService
{
    public static function paymentType($paymentStatus)
    {
        switch ($paymentStatus) {
            case PaymentStatus::REFUNDED:
            case PaymentStatus::CANCELLED:
                return PaymentType::CANCELLATION_REFUND;
            default:
                return PaymentType::DEPOSIT;
        }
    }

    public static function amount($resRate, $paidAmount, $paymentStatus)
    {
        switch ($paymentStatus) {
            case PaymentStatus::PAID:
                return $resRate - $paidAmount;
            case PaymentStatus::REFUNDED:
            case PaymentStatus::CANCELLED:
                return -$paidAmount;
            default:
                return 0;
        }
    }
}
