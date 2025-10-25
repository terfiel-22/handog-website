<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Promo
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createPromo($attributes)
    {
        return $this->db->query(
            "INSERT INTO 
                promos(title,description,discount_value,start_date,end_date,is_active) 
            VALUES (:title,:description,:discount_value,:start_date,:end_date,:is_active)",
            $attributes
        )->id();
    }

    public function fetchPromos()
    {
        return $this->db->query(
            "
            SELECT
                *
            FROM promos
            "
        )->get();
    }

    public function deletePromo($id)
    {
        $result = $this->db->query(
            "DELETE FROM promos WHERE id = :id",
            compact('id')
        );
    }
}
