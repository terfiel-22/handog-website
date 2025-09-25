<?php

namespace Http\Models;

use Core\App;
use Core\Database;

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
            "INSERT INTO reservations(facility_id, contact_person, contact_no, contact_email, contact_address, check_in, check_out, rent_videoke, guest_count, total_price) VALUES(:facility_id, :contact_person, :contact_no, :contact_email, :contact_address, :check_in, :check_out, :rent_videoke, :guest_count, :total_price)",
            $attributes
        )->id();
    }

    public function fetchReservations()
    {
        return $this->db->query('SELECT res.*, fac.name as facility FROM reservations res INNER JOIN facilities fac ON fac.id=res.facility_id')->get();
    }
}
