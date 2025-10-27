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


    public function fetchPromoById($id)
    {
        return $this->db->query(
            "
            SELECT 
                pr.*, 
                GROUP_CONCAT(pf.facility_id) AS facilities
            FROM promos pr
            LEFT JOIN promo_facilities pf ON pr.id = pf.promo_id
            WHERE pr.id = :id
            GROUP BY pr.id
            LIMIT 1
            ",
            compact('id')
        )->findOrFail();
    }

    public function updatePromo($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE promos 
            SET title = :title,
                description = :description,
                discount_value = :discount_value,
                start_date = :start_date,
                end_date = :end_date,
                is_active = :is_active
            WHERE id = :id",
            $attributes
        );
    }

    public function deletePromo($id)
    {
        $result = $this->db->query(
            "DELETE FROM promos WHERE id = :id",
            compact('id')
        );
    }
}
