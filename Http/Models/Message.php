<?php

namespace Http\Models;

use Core\App;
use Core\Database;
use Http\Enums\YesNo;

class Message
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createMessage($attributes)
    {
        return $this->db->query(
            "INSERT INTO messages(name, email, concern, message) VALUES(:name, :email, :concern, :message)",
            $attributes
        )->id();
    }

    public function updateMessage($id, $attributes)
    {
        $attributes['id'] = $id;

        return $this->db->query(
            "UPDATE messages 
            SET is_read = :is_read 
            WHERE id = :id",
            $attributes
        );
    }

    public function fetchMessages()
    {
        return $this->db->query('SELECT * FROM messages')->get();
    }

    public function fetchUnreadMessages()
    {
        $is_read = YesNo::NO;
        return $this->db->query('SELECT * FROM messages WHERE is_read=:is_read', compact('is_read'))->get();
    }

    public function fetchMessageById($id)
    {
        return $this->db->query('SELECT * FROM messages WHERE id=:id', compact('id'))->findOrFail();
    }

    public function deleteMessage($id)
    {
        $this->db->query(
            "DELETE FROM messages WHERE id = :id",
            compact('id')
        );
    }
}
