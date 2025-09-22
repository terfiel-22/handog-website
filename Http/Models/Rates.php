<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Rates
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function fetchRates()
    {
        return $this->db->query('SELECT * FROM st_rates LIMIT 1')->find();
    }
}
