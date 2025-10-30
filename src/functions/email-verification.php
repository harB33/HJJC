<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function generateCode($len = 6)
{
    $char = "0123456789";
    $code = "";

    for ($i = 0; $i < $len; $i++) {
        $code .= $char[rand(0, strlen($char) - 1)];
    }
    return $code;
}

function sendVerification($email, $verificationCode)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "bautistaharvy@gmail.com";
        $mail->Password = "fywv qwve wwir tdtd"; // use Gmail App Password, NOT real password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom("bautistaharvy@gmail.com", "HJJC STORE");
        $mail->addAddress($email);

        $mail->isHTML(false);
        $mail->Subject = "Email Verification";
        $mail->Body = "Your Verification Code is: $verificationCode";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}