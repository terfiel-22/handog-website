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
            "INSERT INTO payments(reservation_id, amount, payment_method, payment_status, transaction_reference) VALUES(:reservation_id, :amount, :payment_method, :payment_status, :transaction_reference)",
            $attributes
        )->id();
    }
}
