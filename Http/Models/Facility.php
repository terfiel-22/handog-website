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
        $this->db->query(
            "INSERT INTO facilities(name, type, description, image, capacity, price, amenities, status) VALUES(:name, :type, :description,:image, :capacity, :price, :amenities, :status)",
            $attributes
        );
    }

    public function fetchFacilityById($id)
    {
        return $this->db->query('SELECT * FROM facilities WHERE id=:id', compact('id'))->findOrFail();
    }

    public function fetchFacilities()
    {
        return $this->db->query('SELECT * FROM facilities')->get();
    }

    public function fetchAvailableFacilities()
    {
        return $this->db->query('SELECT * FROM facilities WHERE status=:status', [
            'status' => FacilityStatus::AVAILABLE
        ])->get();
    }

    public function fetchFacilitiesByType($type)
    {
        return $this->db->query('SELECT * FROM facilities WHERE type=:type', compact('type'))->get();
    }

    public function deleteFacility($id)
    {
        $this->db->query(
            "DELETE FROM facilities WHERE id = :id",
            compact('id')
        );
    }
}
