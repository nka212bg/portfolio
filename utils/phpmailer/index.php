<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/src/Exception.php';
require_once __DIR__ . '/src/PHPMailer.php';
require_once __DIR__ . '/src/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'] . '/utils/dotEnvInit.php';



function sendEmail($from, $subject, $text = null)
{
    $toEmail = $_ENV["email"];
    $status = 'success';
    is_array($toEmail) || ($toEmail = [$toEmail]);

    foreach ($toEmail as $to) {
        try {
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;


            $mail->Username = $to;
            $mail->Password = $_ENV["password"];

            // Sender and recipient settings
            // send as yourself (Gmail rejects/rewrites a foreign From), replies go to the visitor
            $mail->setFrom($to, 'Portfolio');
            $mail->addReplyTo($from);
            $mail->addAddress($to);

            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = $subject;
            $esc = fn($s) => htmlspecialchars($s ?? '', ENT_QUOTES, 'UTF-8');
            $mail->Body = "<h1>" . $esc($subject) . "</h1><br/>" .  "<h3>from email: " . $esc($from) . "</h3><br/>" .  "<p>" . nl2br($esc($text)) . "</p>";

            $mail->send();
            $status = 'success';
        } catch (Exception $e) {
            $status = "Error in sending email: {$mail->ErrorInfo}";
        }
    }

    return $status;
}
