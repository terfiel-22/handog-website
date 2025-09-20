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
            "INSERT INTO entrance_rates(time_slot, adult_rate, kid_rate, senior_pwd_discount) VALUES(:time_slot, :adult_rate, :kid_rate,:senior_pwd_discount)",
            $attributes
        );
    }

    public function fetchEntranceRates()
    {
        return $this->db->query('SELECT * FROM entrance_rates')->get();
    }
}
