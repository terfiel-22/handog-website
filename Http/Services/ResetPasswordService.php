<?php

namespace Http\Services;

use Core\App;
use Http\Helpers\EmailHelper;

class ResetPasswordService
{
    public static function generateResetPin()
    {
        return (int) random_int(100000, 999999);
    }

    public static function emailResetPin($userEmail, $userName, $resetPin)
    {
        $websiteName = WEBSITE_NAME;
        $subject = "Your Password Reset PIN";

        $body = "
            <p>Hi <strong>$userName</strong>,</p>
            <p>You requested to reset your password.</p>
            <p>Your reset PIN is:</p>

            <h2 style=\"font-size: 28px; margin: 10px 0; font-weight: bold;\">$resetPin</h2>

            <p>Please enter this PIN in the website to continue resetting your password.</p>
            <br>

            <p>If you did not request this, you can safely ignore this email.</p>
            <p>Thank you, <br>$websiteName</p>
        ";

        $altBody = "
                Hi $userName,

                You requested to reset your password.

                Your reset PIN is: $resetPin

                Please enter this PIN in the app to continue resetting your password.

                If you did not request this, simply ignore this message.

                Thank you,
                $websiteName
        ";

        // Send email
        App::resolve(EmailHelper::class)->sendEmail($userEmail, $userName, $subject, $body, $altBody);
    }
}
