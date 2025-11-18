<?php

namespace Http\Services;

use Core\App;
use Http\Models\AuditTrail;

class AuditTrailService
{
    protected static function auditTrailModel()
    {
        return App::resolve(AuditTrail::class);
    }

    public static function audit_log($user_id, $action, $module, $oldValue = null, $newValue = null)
    {
        $auditTrailModel = self::auditTrailModel();

        $ip = $_SERVER['REMOTE_ADDR'] ?? null;
        $agent = $_SERVER['HTTP_USER_AGENT'] ?? null;

        // Convert arrays/objects to JSON
        if (is_array($oldValue) || is_object($oldValue)) {
            $oldValue = json_encode($oldValue);
        }
        if (is_array($newValue) || is_object($newValue)) {
            $newValue = json_encode($newValue);
        }

        $newAuditLog = [
            "user_id" => $user_id,
            "action" => $action,
            "module" => $module,
            "old_value" => $oldValue,
            "new_value" => $newValue,
            "ip_address" => $ip,
            "user_agent" => $agent,
        ];

        return $auditTrailModel->createAuditTrail($newAuditLog);
    }
}
