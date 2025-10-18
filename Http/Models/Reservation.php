<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Http\Enums\ReservationStatus;

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

    public function uncompleteReservations()
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
        WHERE NOT
            res.status=:status 
        ", [
            "status" => ReservationStatus::COMPLETED,
        ])->get();
    }

    public function fetchPaidReservationById($id)
    {
        return $this->db->query(
            "
            SELECT 
                res.*, p.payment_status
            FROM 
                reservations res
            INNER JOIN 
                payments p 
            ON 
                res.id=p.reservation_id
            WHERE
                res.id=:id 
        ",
            compact('id')
        )->findOrFail();
    }
}
