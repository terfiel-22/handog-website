<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class GalleryImage
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createGalleryImage($attributes)
    {
        return $this->db->query(
            "INSERT INTO gallery_images(name, description, image) VALUES(:name, :description, :image)",
            $attributes
        )->id();
    }
}
