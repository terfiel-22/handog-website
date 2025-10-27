<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class PromoFacility
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createPromoFacility($attributes)
    {
        return $this->db->query(
            "INSERT INTO 
                promo_facilities(promo_id,facility_id) 
            VALUES (:promo_id,:facility_id)",
            $attributes
        )->id();
    }


    public function deletePromoFacility($promo_id)
    {
        $this->db->query(
            "DELETE FROM promo_facilities WHERE promo_id = :promo_id",
            compact('promo_id')
        );
    }
}
