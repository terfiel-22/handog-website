<?php

namespace Http\Helpers;

use Core\App;
use Http\Helpers\EmailHelper;

class ContactHelper
{
    private string $ownerEmail;
    private string $ownerName;

    public function __construct($config)
    {
        $this->ownerEmail = $config["email"];
        $this->ownerName = $config["name"];
    }

    public function sendEmailForGuestConcern($attributes)
    {
        extract($attributes);

        // Email subject
        $subject = "New Concern Submitted from {$name}";

        // HTML body
        $body = "
        <h2>New Concern Submitted</h2>
        <p>Hello <b>Handog Resort</b> Team,</p>
        <p>You have received a new concern from your website contact form.</p>

        <div style='background-color:#f0f8ff;border-left:4px solid #0077b6;padding:15px;margin:20px 0;line-height:1.6;'>
            <p><strong>Sender Name:</strong> {$name}</p>
            <p><strong>Sender Email:</strong> {$email}</p>
            <p><strong>Concern Type:</strong> {$concern}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        </div>

        <p>Please respond to the guest as soon as possible.</p>

        <p style='font-size:12px;color:#666;margin-top:30px;'>— Handog Resort Website System</p>
    ";

        $altBody = "New Concern Submitted\n\n"
            . "Sender Name: {$name}\n"
            . "Sender Email: {$email}\n"
            . "Concern Type: {$concern}\n"
            . "Message:\n{$message}\n\n"
            . "Please respond to the guest as soon as possible.\n\n"
            . "— Handog Resort Website System";

        App::resolve(EmailHelper::class)->sendEmail($this->ownerEmail, $this->ownerName, $subject, $body, $altBody);
    }
}
