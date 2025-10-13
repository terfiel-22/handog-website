<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Faq
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createFaq($attributes)
    {
        return $this->db->query(
            "INSERT INTO faqs(question, answer) VALUES(:question, :answer)",
            $attributes
        )->id();
    }

    public function updateFaq($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE faqs 
            SET question = :question,
                answer = :answer
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchFaqs()
    {
        return $this->db->query('SELECT * FROM faqs')->get();
    }

    public function fetchFaqById($id)
    {
        return $this->db->query('SELECT * FROM faqs WHERE id=:id', compact('id'))->findOrFail();
    }


    public function deleteFaq($id)
    {
        $this->db->query(
            "DELETE FROM faqs WHERE id = :id",
            compact('id')
        );
    }
}
