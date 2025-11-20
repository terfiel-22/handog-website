<?php

date_default_timezone_set('Asia/Manila');

const BASE_PATH = __DIR__ . "/../";

require BASE_PATH . "vendor/autoload.php";
require BASE_PATH . "Core/functions.php";
require base_path("bootstrap.php");

use Core\App;
use Core\Database;
use Http\Enums\ReservationStatus;

$today = (new DateTime())->format('Y-m-d H:i:s');
$status = ReservationStatus::CONFIRMED;
$new_status = ReservationStatus::COMPLETED;

$sql = "
    UPDATE reservations
    SET status = :new_status
    WHERE check_out < :today
      AND status = :status
";

App::resolve(Database::class)->query($sql, compact('today', 'status', 'new_status'));
