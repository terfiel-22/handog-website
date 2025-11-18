<?php

namespace Http\Models;

use Core\App;
use Core\Database;

class AuditTrail
{
    protected Database $db;

    public function __construct()
    {
        $this->db = App::resolve(Database::class);
    }

    public function createAuditTrail($attributes)
    {
        return $this->db->query(
            "INSERT INTO audit_trail(user_id, action, module, old_value, new_value, ip_address, user_agent) VALUES(:user_id, :action, :module, :old_value, :new_value, :ip_address, :user_agent)",
            $attributes
        )->id();
    }
}
