<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class AmenityImage
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createAmenityImage($attributes)
    {
        $this->db->query(
            "INSERT INTO amenity_images(amenity_id, image) VALUES(:amenity_id, :image)",
            $attributes
        );
    }

    public function deleteAmenityImageByPath($image)
    {
        $this->db->query(
            "DELETE FROM amenity_images WHERE image = :image",
            compact('image')
        );
    }
}
