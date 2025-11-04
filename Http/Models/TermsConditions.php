<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class TermsConditions
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function fetchTermsConditions()
    {
        return $this->db->query('SELECT * FROM st_terms_conditions LIMIT 1')->find();
    }


    public function fetchTermsConditionsById($id)
    {
        return $this->db->query('SELECT * FROM st_terms_conditions WHERE id=:id', compact('id'))->find();
    }

    public function createTermsConditions($attributes)
    {
        $this->db->query("INSERT INTO st_terms_conditions(filepath) VALUES(:filepath)", $attributes);
    }

    public function updateTermsConditions($attributes)
    {
        $this->db->query("UPDATE st_terms_conditions SET filepath=:filepath WHERE id = :id", $attributes);
    }
}
