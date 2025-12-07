<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class SocialDetails
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function fetchSocialDetail()
    {
        return $this->db->query('SELECT * FROM st_social_details LIMIT 1')->find();
    }


    public function fetchSocialDetailById($id)
    {
        return $this->db->query('SELECT * FROM st_social_details WHERE id=:id', compact('id'))->find();
    }

    public function createSocialDetail($attributes)
    {
        $this->db->query("INSERT INTO st_social_details(facebook,instagram,email,contact_no, address) VALUES(:facebook,:instagram,:email,:contact_no, :address)", $attributes);
    }

    public function updateSocialDetail($attributes)
    {
        $this->db->query("UPDATE st_social_details SET facebook=:facebook,instagram=:instagram,email=:email,contact_no=:contact_no, address=:address  WHERE id = :id", $attributes);
    }
}
