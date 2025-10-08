<?php

namespace Http\Helpers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailHelper
{
    private PHPMailer $mailer;
    private string $fromEmail;
    private string $fromName;

    public function __construct(array $config)
    {
        $this->mailer = new PHPMailer(true);

        // SMTP Configuration
        $this->mailer->isSMTP();
        $this->mailer->Host       = $config['host'] ?? 'smtp.gmail.com';
        $this->mailer->SMTPAuth   = true;
        $this->mailer->Username   = $config['email'] ?? '';
        $this->mailer->Password   = $config['password'] ?? '';
        $this->mailer->SMTPSecure = $config['encryption'] ?? PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port       = $config['port'] ?? 587;

        $this->fromEmail = $config['from_email'] ?? $config['email'];
        $this->fromName  = $config['from_name'] ?? 'Mailer';
    }

    public function sendEmail(string $toEmail, string $toName, string $subject, string $body, string $altBody = '')
    {
        try {
            // Recipients
            $this->mailer->setFrom($this->fromEmail, $this->fromName);
            $this->mailer->addAddress($toEmail, $toName);

            // Content
            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body    = $body;
            $this->mailer->AltBody = $altBody ?: strip_tags($body);

            $this->mailer->send();
        } catch (Exception $e) {
            error_log("❌ Email could not be sent. Error: {$this->mailer->ErrorInfo}");
        }
    }
}
