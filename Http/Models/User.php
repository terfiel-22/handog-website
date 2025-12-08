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

    public function fetchUserByEmailOrUsername($value)
    {
        return $this->db->query(
            "SELECT * FROM users WHERE email=:value OR username=:value",
            compact('value')
        )->find();
    }


    public function fetchUserById($id)
    {
        return $this->db->query(
            "SELECT * FROM users WHERE id=:id",
            compact('id')
        )->findOrFail();
    }

    public function createUser($attributes)
    {
        $this->db->query(
            "INSERT INTO users(username,email,image,password,salt,type) VALUES(:username,:email,:image,:password,:salt,:type)",
            $attributes
        );
        return true;
    }

    public function updateUser($id, $attributes)
    {
        $attributes["id"] = $id;

        $this->db->query(
            "UPDATE 
                users 
            SET 
                username=:username,
                email=:email,
                image=:image,
                type=:type
            WHERE 
                id=:id",
            $attributes
        );

        return true;
    }

    public function updateUserPassword($id, $attributes)
    {
        $attributes["id"] = $id;

        $this->db->query(
            "UPDATE 
                users 
            SET 
                password=:password,
                salt=:salt,
                session_token=:session_token,
                reset_pin=:reset_pin
            WHERE 
                id=:id",
            $attributes
        );

        return true;
    }

    public function updateUserFirstTimeLogin($id, $attributes)
    {
        $attributes["id"] = $id;

        $this->db->query(
            "UPDATE 
                users 
            SET 
                first_time_login=:first_time_login
            WHERE 
                id=:id",
            $attributes
        );

        return true;
    }

    public function fetchUserByResetPin($reset_pin)
    {

        return $this->db->query(
            "SELECT * FROM users WHERE reset_pin=:reset_pin",
            compact('reset_pin')
        )->find();
    }

    public function updateResetPin($id, $attributes)
    {
        $attributes["id"] = $id;

        $this->db->query(
            "UPDATE 
                users 
            SET  
                reset_pin=:reset_pin
            WHERE 
                id=:id",
            $attributes
        );

        return true;
    }

    public function updateUserSessionToken($attributes)
    {
        $this->db->query(
            "UPDATE 
                users 
            SET  
                session_token=:session_token
            WHERE 
                id=:id",
            $attributes
        );

        return true;
    }

    public function deleteUser($id)
    {
        $this->db->query(
            "DELETE FROM users WHERE id = :id",
            compact('id')
        );
    }
}
