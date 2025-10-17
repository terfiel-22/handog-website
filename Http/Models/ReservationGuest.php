<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class ReservationGuest
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createReservationGuest($attributes)
    {
        $this->db->query(
            "INSERT INTO reservation_guests(reservation_id, guest_name, guest_age, guest_type, senior_pwd) VALUES(:reservation_id, :guest_name, :guest_age, :guest_type, :senior_pwd)",
            $attributes
        );
    }

    public function fetchGuestsByReservationId($reservation_id)
    {
        return $this->db->query(
            "
        SELECT 
            *
        FROM 
            reservation_guests  
        WHERE
            reservation_id=:reservation_id
        ",
            compact('reservation_id')
        )->get();
    }
}
