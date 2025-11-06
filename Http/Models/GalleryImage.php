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
            "INSERT INTO gallery_images(folder_id, image) VALUES(:folder_id, :image)",
            $attributes
        )->id();
    }

    public function updateGalleryImage($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE gallery_images 
            SET folder_id = :folder_id, 
                image = :image
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchGalleryImages()
    {
        return $this->db->query('SELECT * FROM gallery_images')->get();
    }

    public function fetchGalleryImageById($id)
    {
        return $this->db->query('SELECT * FROM gallery_images WHERE id=:id', compact('id'))->findOrFail();
    }


    public function deleteGalleryImage($id)
    {
        $this->db->query(
            "DELETE FROM gallery_images WHERE id = :id",
            compact('id')
        );
    }

    public function deleteGalleryImageByPath($image)
    {
        $this->db->query(
            "DELETE FROM gallery_images WHERE image = :image",
            compact('image')
        );
    }
}
