<?php

namespace Core;

use Http\Enums\UserType;
use Http\Enums\YesNo;
use Http\Models\User;

class Authenticator
{
    public function attempt(array $attributes): bool
    {
        extract($attributes);

        $user = App::resolve(User::class)->fetchUserByEmailOrUsername($email);

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
        // If user is staff and first time login:
        if ($user['type'] == UserType::STAFF && $user["first_time_login"] == YesNo::YES) {
            create_cookie('new_account_email', $user['email']);
            redirect('/new-account-reset-password');
            die();
        }

        $session_token = generateSessionToken($user["id"]);
        $updatedUser = [
            'id' => $user["id"],
            'session_token' => $session_token,
        ];
        App::resolve(User::class)->updateUserSessionToken($updatedUser);

        create_cookie('session_token', $session_token);
    }

    public function logout()
    {
        destroy_cookie('session_token');
    }
}
