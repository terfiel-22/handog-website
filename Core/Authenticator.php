<?php

namespace Core;

use Http\Models\User;

class Authenticator
{
    public function attempt(array $attributes): bool
    {
        extract($attributes);

        $user = App::resolve(User::class)->fetchUserByEmail($email);

        if ($user) {
            if (password_verify($user['salt'] . $password, $user['password'])) {
                $this->login($user);

                return true;
            }
        }

        return false;
    }

    private function login($user): void
    {
        $session_token = generateSessionToken($user["id"]);
        $updatedUser = [
            'id' => $user["id"],
            'username' => $user["username"],
            'email' => $user["email"],
            'password' => $user["password"],
            'salt' => $user["salt"],
            'session_token' => $session_token,
        ];
        App::resolve(User::class)->updateUser($updatedUser);

        $expiration = 60 * 60 * 24; // 1 day

        $params = session_get_cookie_params();
        setcookie('session_token', $session_token, time() + $expiration, $params['path'], $params['domain'], $params['httponly']);
    }

    public function logout()
    {
        $expiration = 60 * 60 * 24; // 1 day

        $params = session_get_cookie_params();
        setcookie('session_token', '', time() - $expiration, $params['path'], $params['domain'], $params['httponly']);
    }
}
