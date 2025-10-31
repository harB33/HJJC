<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// 1. We USE the Mpdf library
use Mpdf\Mpdf;

function generateCode($len = 6)
{
    $char = "0123456789";
    $code = "";

    for ($i = 0; $i < $len; $i++) {
        $code .= $char[rand(0, strlen($char) - 1)];
    }
    return $code;
}

/**
 * 2. This is the MPDF version of the function
 */
function createWelcomePDF($firstName)
{
    try {
        // 3. We CREATE a new MPDF object
        $mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8',
            'format' => 'A4',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        // 4. We get the logo and Base64-encode it (most reliable method)
        $logoPath = __DIR__ . '/../image/logo/logo.png';
        $logoData = file_get_contents($logoPath);
        $logoBase64 = 'data:image/png;base64,' . base64_encode($logoData);
        $year = date("Y");

        // 5. This is the MODERN HTML that mpdf can render
        $html = '
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
                    font-size: 16px;
                    line-height: 1.6;
                    color: #333;
                    background-color: #f8f9fa; /* Light grey page background */
                    margin: 0;
                    padding: 0;
                }
                .wrapper {
                    width: 100%;
                    padding: 40px;
                    box-sizing: border-box; 
                }
                .container {
                    width: 100%;
                    max-width: 600px; 
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 1px solid #e9ecef;
                    border-radius: 8px; /* mpdf supports this! */
                    overflow: hidden; 
                }
                .header {
                    text-align: center;
                    padding: 40px 40px 30px 40px;
                    border-bottom: 1px solid #e9ecef;
                }
                // .header img {
                //     width: 100px; 
                //     margin-bottom: 20px;
                // }
                .header h1 {
                    font-size: 26px;
                    font-weight: 600;
                    color: #212529;
                    margin: 0;
                }
                .content {
                    padding: 40px;
                }
                .content p {
                    margin-bottom: 20px;
                }
                .highlight {
                    font-weight: 600; 
                    color: #0d6efd; 
                }
                .next-steps {
                    padding: 0 40px 40px 40px;
                }
                .next-steps h3 {
                    font-size: 20px;
                    font-weight: 600;
                    color: #212529;
                    margin-bottom: 15px;
                }
                .next-steps ul {
                    list-style-type: none; 
                    padding-left: 0;
                    margin: 0;
                }
                .next-steps li {
                    position: relative;
                    padding-left: 30px; 
                    margin-bottom: 10px;
                }
                /* mpdf supports ::before! */
                .next-steps li::before {
                    content: "✔"; 
                    position: absolute;
                    left: 0;
                    top: 0;
                    color: #0d6efd; 
                    font-size: 18px;
                }
                .footer {
                    text-align: center;
                    padding: 30px 40px;
                    font-size: 14px;
                    color: #888;
                    background-color: #f8f9fa;
                    border-top: 1px solid #e9ecef;
                }
                .footer p {
                    margin: 5px 0 0 0;
                }
            </style>
        </head>
        <body>
            <div class="wrapper">
                <div class="container">
                    <div class="header">
                        <img src="' . $logoBase64 . '" alt="HJJC Store Logo" style="width: 120px; margin-bottom: 20px;">
                        <h1>Welcome to HJJC Store!</h1>
                    </div>
                    <div class="content">
                        <p>Hi ' . htmlspecialchars($firstName) . ',</p> 
                        <p>
                            Thank you for creating an account with <strong>HJJC Store</strong>! 
                            You\'ve just unlocked your new one-stop shop for 
                            <span class="highlight">everything you need.</span>
                        </p>
                    </div>
                    <div class="next-steps">
                        <h3>What\'s Next?</h3>
                        <ul>
                            <li><strong>Start Exploring:</strong> Dive into our huge selection of categories.</li>
                            <li><strong>Track Your Orders:</strong> Manage your purchases and see shipping updates.</li>
                            <li><strong>Find Great Deals:</strong> Don\'t miss the exclusive offers on our homepage.</li>
                        </ul>
                    </div>
                    <div class="footer">
                        <p>We\'re thrilled to have you with us. Happy shopping!</p>
                        <p>&copy; ' . $year . ' HJJC Store. All rights reserved.</p>
                    </div>
                </div>
            </div>
        </body>
        </html>
        ';

        // 6. WRITE THE HTML AND RETURN AS A STRING
        $mpdf->WriteHTML($html);
        return $mpdf->Output('welcome.pdf', 'S'); // 'S' returns as a string

    } catch (\Exception $e) {
        // Return an error string if PDF generation fails
        return "PDF Error: " . $e->getMessage();
    }
}

/**
 * 7. This is the sendVerification function
 */
function sendVerification($email, $verificationCode, $firstName)
{
    $mail = new PHPMailer(true);

    try {
        // --- SMTP Settings (Port 465) ---
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "hjjc.store@gmail.com";
        $mail->Password = "xxhx nkiw bwsi erwb";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // --- Recipients ---
        $mail->setFrom("hjjc.store@gmail.com", "HJJC STORE");
        $mail->addAddress($email);

        // --- Content ---
        $mail->isHTML(true);
        $mail->Subject = "Your HJJC Store Verification Code";

        // --- Attachments & Embedded Images ---

        // 1. Embed logo for the EMAIL
        $imagePath = __DIR__ . '/../image/logo/logo.png';
        $mail->addEmbeddedImage($imagePath, 'logo-hjjc');

        // 2. Generate and attach the dynamic PDF
        $pdfData = createWelcomePDF($firstName); // This uses mpdf

        // 3. Check if PDF generation failed
        if (strpos($pdfData, 'PDF Error:') === 0) {
            return $pdfData;
        }

        // 4. Attach the PDF
        $mail->addStringAttachment($pdfData, "Welcome_to_HJJC_Store.pdf");

        // 5. SET THE NEW EMAIL BODY
        $mail->Body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <style>
                body {
                    margin: 0;
                    padding: 0;
                    background-color: #f8f9fa; /* Light grey background */
                    font-family: Arial, sans-serif;
                }
                table {
                    border-collapse: collapse;
                }
                .wrapper {
                    width: 100%;
                    padding: 40px 0;
                }
                .container {
                    width: 90%;
                    max-width: 600px;
                    margin: 0 auto;
                    background-color: #ffffff;
                    border: 1px solid #e9ecef;
                    border-radius: 8px; /* Supported by many modern clients */
                    overflow: hidden;
                }
                .header {
                    text-align: center;
                    padding: 40px;
                    border-bottom: 1px solid #e9ecef;
                }
                .content {
                    padding: 40px;
                    font-size: 16px;
                    line-height: 1.6;
                    color: #333;
                }
                .content p {
                    margin: 0 0 20px 0;
                }
                .code {
                    font-size: 24px;
                    font-weight: bold;
                    color: #0d6efd; /* Blue */
                }
                .footer {
                    text-align: center;
                    padding: 30px 40px;
                    font-size: 14px;
                    color: #888;
                    background-color: #f8f9fa;
                }
            </style>
        </head>
        <body>
            <table class="wrapper" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td align="center">
                        <table class="container" border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                            <tr>
                                <td class="header" align="center">
                                    <img src="cid:logo-hjjc" alt="HJJC Store Logo" style="width: 120px;">
                                </td>
                            </tr>
                            <tr>
                                <td class="content">
                                    <p>Hi<strong> ' . htmlspecialchars($firstName) . '</strong>,</p>
                                    <p>Welcome to <strong>HJJC Store!</strong> Here is your email verification code:</p>
                                    <p class="code">' . $verificationCode . '</p>
                                    <br>
                                    <p style="margin:0;">We\'ve also attached a personal welcome guide to help you get started!</p>
                                </td>
                            </tr>
                            <tr>
                                <td class="footer" align="center">
                                    <p>&copy; ' . date("Y") . ' HJJC Store. All rights reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>
        ';

        // 6. Set the Plain Text Fallback
        $mail->AltBody = "Your verification code is: $verificationCode. We've also attached a welcome guide.";

        $mail->send();
        return true;
    } catch (Exception $e) {
        return "Mailer Error: " . $mail->ErrorInfo;
    }
}
