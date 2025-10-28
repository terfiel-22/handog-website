<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Logo
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function fetchLogo()
    {
        return $this->db->query('SELECT * FROM st_logos LIMIT 1')->find();
    }


    public function fetchLogoById($id)
    {
        return $this->db->query('SELECT * FROM st_logos WHERE id=:id', compact('id'))->find();
    }

    public function createLogo($attributes)
    {
        $this->db->query("INSERT INTO st_logos(image) VALUES(:image)", $attributes);
    }

    public function updateLogo($attributes)
    {
        $this->db->query("UPDATE st_logos SET image=:image WHERE id = :id", $attributes);
    }
}
