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
            "INSERT INTO reservations(facility_id, contact_person, contact_no, contact_email, contact_address, check_in, time_range, check_out, rent_videoke, guest_count, total_price, status) VALUES(:facility_id, :contact_person, :contact_no, :contact_email, :contact_address, :check_in, :time_range, :check_out, :rent_videoke, :guest_count, :total_price, :status)",
            $attributes
        )->id();
    }

    public function updateReservation($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE reservations 
            SET 
                facility_id = :facility_id,
                contact_person = :contact_person,
                contact_no = :contact_no,
                contact_email = :contact_email,
                contact_address = :contact_address,
                check_in = :check_in,
                time_range = :time_range,
                check_out = :check_out,
                rent_videoke = :rent_videoke,
                guest_count = :guest_count,
                total_price = :total_price,
                status = :status
            WHERE id = :id;
            ",
            $attributes
        );
    }

    public function fetchReservations()
    {
        return $this->db->query("
        SELECT 
            res.*, fac.name as facility, p.payment_status, SUM(p.amount) as total_paid
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

    public function fetchReservationById($id)
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
