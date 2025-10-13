<?php

/** Function for displaying variables */
function dd($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    die();
}

/** Function for getting base_path */
function base_path($path)
{
    return BASE_PATH . $path;
}

/** Function for redirecting to a certain path. */
function redirect($path = null)
{
    $url = $path ?? $_COOKIE['uri'] ?? '/';
    header("location: $url");
    die();
}

/** Function for directly importing file from view folder */
function view($path, $attributes = []): void
{
    extract($attributes);
    require base_path("views/" . $path);
}

/** Function for displaying error in browser */
function abort($code = 404)
{
    http_response_code($code);
    require base_path("/views/errors/$code.view.php");
    die();
}

/** Convert number into currency number format */
function moneyFormat($value)
{
    return "₱ " . number_format($value, 2);
}

/** Function for getting old form data */
function old($key,  $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}

/** Function for handling image path */
function handleImage($image, $default = "/assets/admin/images/unavailable-image.jpg")
{
    return !empty($image) ? "/" . $image : $default;
}

/** Function to return guest type */
function guestType($age)
{
    return $age >= 10 ? \Http\Enums\GuestType::ADULT :  \Http\Enums\GuestType::KID;
}

/** Function to return booking deposit */
function bookingDeposit($total_amount)
{
    return $total_amount / 2;
}

/** Function to return booking format (for calendar js) */
function convertToBookingsFormat(array $data): array
{
    $bookings = [];

    foreach ($data as $row) {
        // Convert check-in and check-out to 'Y-m-d' format
        $checkIn = date('Y-m-d\TH:i:s', strtotime($row['check_in']));
        $checkOut = date('Y-m-d\TH:i:s', strtotime($row['check_out']));

        $bookings[] = [
            'available_unit' => $row["available_unit"],
            'facility_id' => $row["facility_id"],
            'check_in_date' => $checkIn,
            'check_out_date' => $checkOut
        ];
    }

    return $bookings;
}

/** Function to format date time into readable date and time */
function formatDatetimeToReadable($datetime)
{
    $readableDatetime = new DateTime($datetime);

    return $readableDatetime->format('h:i A | M. d, Y');
}

/** Function to generate a session token given user id*/
function generateSessionToken($uid)
{
    $dataToHash = $uid . time();
    $token = password_hash($dataToHash, PASSWORD_BCRYPT);

    return $token;
}
