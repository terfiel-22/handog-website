<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class Event
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createEvent($attributes)
    {
        return $this->db->query(
            "INSERT INTO events(name, description, date, image) VALUES(:name, :description, :date, :image)",
            $attributes
        )->id();
    }

    public function updateEvent($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE events 
            SET name = :name,
                description = :description,
                date = :date,
                image = :image
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchEvents()
    {
        return $this->db->query('SELECT * FROM events')->get();
    }

    public function fetchUpcomingEvents()
    {
        return $this->db->query('SELECT * FROM events WHERE date >= CURDATE() ORDER BY date ASC LIMIT 5')->get();
    }

    public function fetchEventById($id)
    {
        return $this->db->query('SELECT * FROM events WHERE id=:id', compact('id'))->findOrFail();
    }


    public function deleteEvent($id)
    {
        $this->db->query(
            "DELETE FROM events WHERE id = :id",
            compact('id')
        );
    }
}
