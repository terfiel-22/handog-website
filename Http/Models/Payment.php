<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Payment
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createPayment($attributes)
    {
        return $this->db->query(
            "INSERT INTO payments(reservation_id, amount, payment_method, payment_status, payment_link) VALUES(:reservation_id, :amount, :payment_method, :payment_status, :payment_link)",
            $attributes
        )->id();
    }


    public function retrievePaymentByPaymentLink($payment_link)
    {
        return $this->db->query(
            "SELECT * FROM payments WHERE payment_link=:payment_link",
            compact('payment_link')
        )->findOrFail();
    }

    public function updatePayment($attributes)
    {
        $this->db->query(
            "UPDATE payments SET payment_method=:payment_method, payment_status=:payment_status WHERE id=:id",
            $attributes
        );
    }
}
