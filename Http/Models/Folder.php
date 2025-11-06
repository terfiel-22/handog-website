<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Folder
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createFolder($attributes)
    {
        return $this->db->query(
            "INSERT INTO folders(name, description) VALUES(:name, :description)",
            $attributes
        )->id();
    }

    public function updateFolder($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE folders 
            SET name = :name,
                description = :description
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchFolders()
    {
        return $this->db->query('SELECT * FROM folders')->get();
    }

    public function fetchFoldersWithImages()
    {
        return $this->db->query(
            "
            SELECT 
                f.id,
                f.name,
                f.description,
                GROUP_CONCAT(gi.image) AS images
            FROM folders f
            LEFT JOIN gallery_images gi ON f.id = gi.folder_id 
            GROUP BY f.id 
            "
        )->get();
    }

    public function fetchFolderById($id)
    {
        return $this->db->query("
            SELECT 
                f.id,
                f.name,
                f.description,
                GROUP_CONCAT(gi.image) AS images
            FROM folders f
            LEFT JOIN gallery_images gi ON f.id = gi.folder_id 
            WHERE f.id=:id
            GROUP BY f.id 
        ", compact('id'))->findOrFail();
    }


    public function deleteFolder($id)
    {
        $this->db->query(
            "DELETE FROM folders WHERE id = :id",
            compact('id')
        );
    }
}
