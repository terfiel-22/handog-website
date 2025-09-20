<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class EntrancePricing
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createEntrancePricing($attributes)
    {
        $this->db->query(
            "INSERT INTO entrance_pricing(name, type, description, image, capacity, price, amenities, status) VALUES(:name, :type, :description,:image, :capacity, :price, :amenities, :status)",
            $attributes
        );
    }
}
