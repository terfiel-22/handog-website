<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function fetchUsers()
    {
        return $this->db->query(
            "SELECT * FROM users"
        )->get();
    }

    public function fetchUserBySessionToken($session_token)
    {
        return $this->db->query(
            "SELECT * FROM users WHERE session_token=:session_token",
            compact('session_token')
        )->find();
    }

    public function fetchUserByEmail($email)
    {
        return $this->db->query(
            "SELECT * FROM users WHERE email=:email",
            compact('email')
        )->find();
    }

    public function createUser($attributes)
    {
        $this->db->query(
            "INSERT INTO users(username,email,password,salt,type) VALUES(:username,:email,:password,:salt,:type)",
            $attributes
        );
        return true;
    }

    public function updateUser($attributes)
    {
        $this->db->query(
            "UPDATE 
                users 
            SET 
                username=:username,
                email=:email,
                password=:password,
                salt=:salt,
                session_token=:session_token
            WHERE 
                id=:id",
            $attributes
        );

        return true;
    }
}
