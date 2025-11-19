<?php

namespace Http\Services;

use Core\App;
use Http\Enums\AuditAction;
use Http\Enums\AuditModule;
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

        // Check if there is no changes
        $oldValue = $oldValue ?? [];
        $newValue = $newValue ?? [];

        $allKeys = array_unique(array_merge(array_keys($oldValue), array_keys($newValue)));
        $changes = [];

        foreach ($allKeys as $key) {
            $oldVal = $oldValue[$key] ?? null;
            $newVal = $newValue[$key] ?? null;

            if ($oldVal !== $newVal) {
                $changes[$key] = [
                    'old' => $oldVal,
                    'new' => $newVal
                ];
            }
        }

        if (empty($changes)) {
            return;
        }


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

    public static function reservation_update_log($user_id, $old, $new)
    {
        $action = $old["status"] == $new["status"] ? AuditAction::RESERVATION_UPDATED : AuditModule::RESERVATION . " " . ucfirst($new["status"]);
        $module = AuditModule::RESERVATION;

        self::audit_log(
            $user_id,
            $action,
            $module,
            $old,
            $new,
        );
    }

    public static function payment_update_log($user_id, $old, $new)
    {
        $action = $old["payment_status"] == $new["payment_status"] ? AuditAction::PAYMENT_UPDATED : AuditModule::PAYMENT . " " . ucfirst($new["payment_status"]);
        $module = AuditModule::PAYMENT;

        self::audit_log(
            $user_id,
            $action,
            $module,
            $old,
            $new,
        );
    }
}
