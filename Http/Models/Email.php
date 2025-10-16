<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Http\Enums\YesNo;

class Email
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createEmail($attributes)
    {
        return $this->db->query(
            "INSERT INTO emails(name, email, concern, message) VALUES(:name, :email, :concern, :message)",
            $attributes
        )->id();
    }

    public function updateEmail($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE emails 
            SET is_read = :is_read 
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchEmails()
    {
        return $this->db->query('SELECT * FROM emails')->get();
    }

    public function fetchUnreadEmails()
    {
        $is_read = YesNo::NO;
        return $this->db->query('SELECT * FROM emails WHERE is_read=:is_read', compact('is_read'))->get();
    }

    public function fetchEmailById($id)
    {
        return $this->db->query('SELECT * FROM emails WHERE id=:id', compact('id'))->findOrFail();
    }

    public function deleteEmail($id)
    {
        $this->db->query(
            "DELETE FROM emails WHERE id = :id",
            compact('id')
        );
    }
}
