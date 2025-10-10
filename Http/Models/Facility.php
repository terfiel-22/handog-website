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
            "INSERT INTO facilities(name, type, available_unit, capacity, description, rate_hourly, rate_8hrs, rate_12hrs, rate_1day, amenities) VALUES(:name, :type, :available_unit, :capacity, :description, :rate_hourly, :rate_8hrs, :rate_12hrs, :rate_1day, :amenities)",
            $attributes
        )->id();
    }

    public function updateFacility($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE facilities 
            SET name = :name,
                type = :type,
                available_unit = :available_unit,
                capacity = :capacity,
                description = :description,
                rate_hourly = :rate_hourly,
                rate_8hrs = :rate_8hrs,
                rate_12hrs = :rate_12hrs,
                rate_1day = :rate_1day,
                amenities = :amenities
            WHERE id = :id",
            $attributes
        );
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
            SELECT
                fac.*,
                fi.image
            FROM facilities fac
            LEFT JOIN facility_images fi 
                ON fi.id = (
                    SELECT MIN(id) 
                    FROM facility_images 
                    WHERE facility_id = fac.id
                )
            GROUP BY fac.id;
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
            SELECT
                fac.*,
                fi.image
            FROM facilities fac
            LEFT JOIN facility_images fi 
                ON fi.id = (
                    SELECT MIN(id) 
                    FROM facility_images 
                    WHERE facility_id = fac.id
                )
            WHERE fac.type=:type
            GROUP BY fac.id;
            ",
            compact('type')
        )->get();
    }

    public function fetchSingleFacilityWithImagesByType($type)
    {
        return $this->db->query(
            "
            SELECT 
                fac.*, 
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

    public function fetchSingleFacilityWithImagesById($id)
    {
        return $this->db->query(
            "
            SELECT 
                fac.*, 
                GROUP_CONCAT(fi.image) AS images
            FROM facilities fac
            LEFT JOIN facility_images fi ON fac.id = fi.facility_id
            WHERE fac.id = :id
            GROUP BY fac.id
            LIMIT 1
            ",
            compact('id')
        )->findOrFail();
    }

    public function deleteFacility($id)
    {
        $this->db->query(
            "DELETE FROM facilities WHERE id = :id",
            compact('id')
        );
    }
}
