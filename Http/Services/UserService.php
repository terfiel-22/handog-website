<?php

namespace Http\Services;

use Core\App;
use Http\Models\User;

class UserService
{
    protected static function userModel()
    {
        return App::resolve(User::class);
    }

    /**
     * Get current user details
     */
    public static function getCurrentUser()
    {
        $userModel = self::userModel();

        if (!isset($_COOKIE['session_token'])) return false;
        $sessionToken = $_COOKIE['session_token'];

        return $userModel->fetchUserBySessionToken($sessionToken);
    }
}
