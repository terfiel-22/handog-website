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
        $this->db->query(
            "INSERT INTO reservations(name, type, description, image, capacity, price, amenities, status) VALUES(:name, :type, :description,:image, :capacity, :price, :amenities, :status)",
            $attributes
        );
    }
}
