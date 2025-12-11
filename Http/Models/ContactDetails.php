<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class ContactDetails
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function fetchContactDetail()
    {
        return $this->db->query('SELECT * FROM st_contact_details LIMIT 1')->find();
    }


    public function fetchContactDetailById($id)
    {
        return $this->db->query('SELECT * FROM st_contact_details WHERE id=:id', compact('id'))->find();
    }

    public function createContactDetail($attributes)
    {
        $this->db->query("INSERT INTO st_contact_details(facebook,instagram,email,contact_no, address) VALUES(:facebook,:instagram,:email,:contact_no, :address)", $attributes);
    }

    public function updateContactDetail($attributes)
    {
        $this->db->query("UPDATE st_contact_details SET facebook=:facebook,instagram=:instagram,email=:email,contact_no=:contact_no, address=:address  WHERE id = :id", $attributes);
    }
}
