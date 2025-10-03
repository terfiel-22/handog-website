<?php

namespace Http\Constants;

class PaymongoPayment
{
    public const METHODS = [
        'gcash'     => 'GCash',
        'grab_pay'  => 'GrabPay',
        'paymaya'   => 'PayMaya',
        'card'      => 'Credit/Debit Card',
        'billease'  => 'BillEase',
    ];
}
