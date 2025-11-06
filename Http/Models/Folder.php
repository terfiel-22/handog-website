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

    public function fetchFolderById($id)
    {
        return $this->db->query('SELECT * FROM folders WHERE id=:id', compact('id'))->findOrFail();
    }


    public function deleteFolder($id)
    {
        $this->db->query(
            "DELETE FROM folders WHERE id = :id",
            compact('id')
        );
    }
}
