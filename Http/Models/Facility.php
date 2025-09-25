<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Http\Enums\FacilityStatus;

class Facility
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createFacility($attributes)
    {
        return $this->db->query(
            "INSERT INTO facilities(name, type, description, capacity, amenities) VALUES(:name, :type, :description, :capacity, :amenities)",
            $attributes
        )->id();
    }

    public function fetchFacilityById($id)
    {
        return $this->db->query("
            SELECT fac.*, fi.image
            FROM facilities fac
            LEFT JOIN facility_images fi 
                ON fi.id = (
                    SELECT MIN(id) 
                    FROM facility_images 
                    WHERE facility_id = fac.id
                )
            WHERE fac.id=:id
        ", compact('id'))->findOrFail();
    }

    public function fetchFacilities()
    {
        return $this->db->query(
            "
            SELECT fac.*, fi.image
            FROM facilities fac
            LEFT JOIN facility_images fi 
                ON fi.id = (
                    SELECT MIN(id) 
                    FROM facility_images 
                    WHERE facility_id = fac.id
                );
            "
        )->get();
    }

    public function fetchAvailableFacilities()
    {
        return $this->db->query('SELECT * FROM facilities WHERE status=:status', [
            'status' => FacilityStatus::AVAILABLE
        ])->get();
    }

    public function fetchFacilitiesByType($type)
    {
        return $this->db->query(
            "
            SELECT fac.*, fi.image
            FROM facilities fac
            LEFT JOIN facility_images fi 
                ON fi.id = (
                    SELECT MIN(id) 
                    FROM facility_images 
                    WHERE facility_id = fac.id
                )
            WHERE fac.type=:type
            ",
            compact('type')
        )->get();
    }

    public function fetchSingleFacilityWithImagesByType($type)
    {
        return $this->db->query(
            "
            SELECT 
                fac.id,
                fac.name,
                fac.description,
                GROUP_CONCAT(fi.image) AS images
            FROM facilities fac
            LEFT JOIN facility_images fi ON fac.id = fi.facility_id
            WHERE fac.type = :type
            GROUP BY fac.id
            LIMIT 1
            ",
            compact('type')
        )->find();
    }

    public function deleteFacility($id)
    {
        $this->db->query(
            "DELETE FROM facilities WHERE id = :id",
            compact('id')
        );
    }
}
