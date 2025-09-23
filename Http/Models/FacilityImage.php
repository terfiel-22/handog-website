<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Http\Enums\FacilityStatus;

class FacilityImage
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createFacilityImage($attributes)
    {
        $this->db->query(
            "INSERT INTO facility_images(facility_id, image) VALUES(:facility_id, :image)",
            $attributes
        );
    }
}
