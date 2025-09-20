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
            "INSERT INTO reservations(facility_id, entrance_rate_id, contact_person, contact_no, contact_email, contact_address, rent_videoke, guest_count, total_price) VALUES(:facility_id, :entrance_rate_id, :contact_person, :contact_no, :contact_email, :contact_address, :rent_videoke, :guest_count, :total_price)",
            $attributes
        )->id();
    }
}
