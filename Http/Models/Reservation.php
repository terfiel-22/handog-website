<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Http\Enums\PaymentStatus;

class Reservation
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createReservation($attributes)
    {
        return $this->db->query(
            "INSERT INTO reservations(facility_id, contact_person, contact_no, contact_email, contact_address, check_in, check_out, rent_videoke, guest_count, total_price, status) VALUES(:facility_id, :contact_person, :contact_no, :contact_email, :contact_address, :check_in, :check_out, :rent_videoke, :guest_count, :total_price, :status)",
            $attributes
        )->id();
    }

    public function fetchReservations()
    {
        return $this->db->query("
        SELECT 
            res.*, fac.name as facility, p.payment_status 
        FROM 
            reservations res 
        INNER JOIN 
            facilities fac 
        ON 
            fac.id=res.facility_id
        INNER JOIN 
            payments p 
        ON 
            res.id=p.reservation_id
        ")->get();
    }

    public function fetchPaidReservations()
    {
        return $this->db->query("
        SELECT 
            res.*, fac.available_unit
        FROM 
            reservations res 
        INNER JOIN 
            facilities fac 
        ON 
            fac.id=res.facility_id
        INNER JOIN 
            payments p 
        ON 
            res.id=p.reservation_id
        WHERE
            p.payment_status=:paid_status
        OR
            p.payment_status=:half_status
        ", [
            "paid_status" => PaymentStatus::PAID,
            "half_status" => PaymentStatus::HALF_PAID
        ])->get();
    }
}
