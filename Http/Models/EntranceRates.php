<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class EntranceRates
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createEntranceRates($attributes)
    {
        $this->db->query(
            "INSERT INTO entrance_rates(guest_type, rate, start_time, end_time) VALUES(:guest_type, :rate, :start_time,:end_time)",
            $attributes
        );
    }

    public function fetchEntranceRates()
    {
        return $this->db->query('SELECT * FROM entrance_rates')->get();
    }
}
