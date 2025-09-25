<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class FacilityRates
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createFacilityRate($attributes)
    {
        $this->db->query(
            "INSERT INTO facility_rates(facility_id, rate, time_range) VALUES(:facility_id, :rate, :time_range)",
            $attributes
        );
    }
}
