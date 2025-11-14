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

    public function updateRates($attributes)
    {
        $this->db->query(
            "
            UPDATE st_rates 
            SET 
                adult_rate_day = :adult_rate_day, 
                adult_rate_night = :adult_rate_night, 
                kid_rate_day = :kid_rate_day, 
                kid_rate_night = :kid_rate_night, 
                senior_pwd_discount = :senior_pwd_discount, 
                videoke_rent = :videoke_rent, 
                additional_bed_rate=:additional_bed_rate,
                pool_extension_rate_adult=:pool_extension_rate_adult,
                pool_extension_rate_kid=:pool_extension_rate_kid,
                cottage_extension_rate=:cottage_extension_rate
            WHERE id = :id",
            $attributes
        );
    }
}
