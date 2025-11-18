<?php

use Core\App;
use Http\Models\AuditTrail;

$audit_logs = App::resolve(AuditTrail::class)->fetchAuditLogs();

view(
    "admin/audit_trail/index.view.php",
    compact('audit_logs')
);
