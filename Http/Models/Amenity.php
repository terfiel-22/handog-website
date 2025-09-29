<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Amenity
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createAmenity($attributes)
    {
        return $this->db->query(
            "INSERT INTO amenities(name, type, description) VALUES(:name, :type, :description)",
            $attributes
        )->id();
    }

    public function fetchAmenities()
    {
        return $this->db->query(
            "
            SELECT
                am.*,
                ai.image
            FROM amenities am
            LEFT JOIN amenity_images ai 
                ON ai.id = (
                    SELECT MIN(id) 
                    FROM amenity_images 
                    WHERE amenity_id = am.id
                )
            GROUP BY am.id;
            "
        )->get();
    }

    public function fetchAmenitiesByType($type)
    {
        return $this->db->query(
            "
            SELECT
                am.*,
                ai.image
            FROM amenities am
            LEFT JOIN amenity_images ai 
                ON ai.id = (
                    SELECT MIN(id) 
                    FROM amenity_images 
                    WHERE amenity_id = am.id
                )
            WHERE am.type=:type
            GROUP BY am.id;
            ",
            compact('type')
        )->get();
    }

    public function deleteAmenity($id)
    {
        $this->db->query(
            "DELETE FROM amenities WHERE id = :id",
            compact('id')
        );
    }
}
