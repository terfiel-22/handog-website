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
            "INSERT INTO payments(reservation_id, amount, payment_method, payment_status, payment_type, payment_link) VALUES(:reservation_id, :amount, :payment_method, :payment_status, :payment_type, :payment_link)",
            $attributes
        )->id();
    }


    public function retrievePaymentByPaymentLink($payment_link)
    {
        return $this->db->query(
            "SELECT 
                p.*, r.contact_person, r.contact_email, r.check_in, r.check_out
            FROM payments p 
            INNER JOIN reservations r 
            ON r.id=p.reservation_id 
            WHERE payment_link=:payment_link",
            compact('payment_link')
        )->findOrFail();
    }

    public function fetchPaymentByReservationId($reservation_id)
    {
        return $this->db->query(
            "SELECT 
                *
            FROM payments  
            WHERE reservation_id=:reservation_id",
            compact('reservation_id')
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
