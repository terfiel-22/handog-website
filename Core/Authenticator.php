<?php

namespace Core;

use Http\Enums\AuditAction;
use Http\Enums\AuditModule;
use Http\Models\User;
use Http\Services\AuditTrailService;
use Http\Services\UserService;

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
            'session_token' => $session_token,
        ];
        App::resolve(User::class)->updateUserSessionToken($updatedUser);

        $expiration = 60 * 60 * 24; // 1 day

        $params = session_get_cookie_params();
        setcookie('session_token', $session_token, time() + $expiration, $params['path'], $params['domain'], $params['httponly']);

        // Audit Log
        AuditTrailService::audit_log(
            $user["id"],
            AuditAction::LOGIN,
            AuditModule::AUTHENTICATION
        );
    }

    public function logout()
    {
        $user = UserService::getCurrentUser();

        $expiration = 60 * 60 * 24; // 1 day

        $params = session_get_cookie_params();
        setcookie('session_token', '', time() - $expiration, $params['path'], $params['domain'], $params['httponly']);

        // Audit Log
        AuditTrailService::audit_log(
            $user["id"],
            AuditAction::LOGOUT,
            AuditModule::AUTHENTICATION
        );
    }
}
