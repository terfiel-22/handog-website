<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Testimonial
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createTestimonial($attributes)
    {
        return $this->db->query(
            "INSERT INTO testimonials(name, description, date, image) VALUES(:name, :description, :date, :image)",
            $attributes
        )->id();
    }

    public function updateTestimonial($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE testimonials 
            SET name = :name,
                description = :description,
                date = :date,
                image = :image
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchTestimonials()
    {
        return $this->db->query('SELECT * FROM testimonials')->get();
    }

    public function fetchTestimonialById($id)
    {
        return $this->db->query('SELECT * FROM testimonials WHERE id=:id', compact('id'))->findOrFail();
    }

    public function deleteTestimonial($id)
    {
        $this->db->query(
            "DELETE FROM testimonials WHERE id = :id",
            compact('id')
        );
    }
}
