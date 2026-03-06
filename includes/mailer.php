<?php
/**
 * Mailer Helper — PHPMailer SMTP wrapper
 * Uses config constants: MAIL_HOST, MAIL_PORT, MAIL_ENCRYPTION,
 *                        MAIL_USER, MAIL_PASS, MAIL_FROM_NAME, SITE_EMAIL
 *
 * Usage:
 *   $result = sendMail('to@example.com', 'Subject', '<p>HTML body</p>');
 *   if ($result['success']) { ... } else { echo $result['error']; }
 */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load PHPMailer autoloader (Composer)
$autoloader = __DIR__ . '/../vendor/autoload.php';
if (!file_exists($autoloader)) {
    error_log('PHPMailer autoloader not found. Run: composer require phpmailer/phpmailer');
}
require_once $autoloader;

/**
 * Send an HTML email via SMTP
 *
 * @param string       $to          Recipient email address
 * @param string       $subject     Email subject
 * @param string       $body        HTML body
 * @param string|null  $replyTo     Optional reply-to address
 * @param string|null  $toName      Optional recipient display name
 * @return array ['success' => bool, 'error' => string]
 */
function sendMail(string $to, string $subject, string $body, ?string $replyTo = null, ?string $toName = null): array
{
    $mail = new PHPMailer(true); // true = throw exceptions

    try {
        // ── SMTP Settings ────────────────────────────────────────
        $mail->isSMTP();
        $mail->Host       = MAIL_HOST;
        $mail->SMTPAuth   = true;
        $mail->Username   = MAIL_USER;
        $mail->Password   = MAIL_PASS;
        $mail->SMTPSecure = (MAIL_ENCRYPTION === 'ssl') ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = MAIL_PORT;
        $mail->CharSet    = 'UTF-8';

        // ── Sender ───────────────────────────────────────────────
        $mail->setFrom(SITE_EMAIL, MAIL_FROM_NAME);

        // ── Reply-To (optional) ──────────────────────────────────
        if ($replyTo) {
            $mail->addReplyTo($replyTo);
        }

        // ── Recipient ─────────────────────────────────────────────
        $mail->addAddress($to, $toName ?? '');

        // ── Content ───────────────────────────────────────────────
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = strip_tags($body); // Plain-text fallback

        $mail->send();
        return ['success' => true, 'error' => ''];

    } catch (Exception $e) {
        $errorMsg = $mail->ErrorInfo;
        error_log('Mailer error to ' . $to . ': ' . $errorMsg);
        return ['success' => false, 'error' => $errorMsg];
    }
}

/**
 * Build a standard branded HTML email template
 *
 * @param string $recipientName  Greeting name
 * @param string $content        Main HTML content block
 * @param string $footer         Optional footer note
 * @return string Full HTML email body
 */
function buildEmailTemplate(string $recipientName, string $content, string $footer = ''): string
{
    $bankName = defined('SITE_NAME') ? SITE_NAME : 'Miraji Bank';
    $bankShort = defined('SITE_NAME_SHORT') ? SITE_NAME_SHORT : 'Miraji Bank';
    $year = date('Y');

    return <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
  body { margin:0; padding:0; background:#f4f4f4; font-family: Arial, sans-serif; }
  .wrapper { max-width:600px; margin:30px auto; background:#ffffff; border-radius:8px; overflow:hidden; box-shadow:0 2px 8px rgba(0,0,0,0.1); }
  .header { background:linear-gradient(135deg,#1e3a8a,#2d5a8c); padding:28px 30px; text-align:center; }
  .header h1 { color:#ffffff; margin:0; font-size:1.3rem; font-weight:700; letter-spacing:0.5px; }
  .header p  { color:rgba(255,255,255,0.75); margin:6px 0 0; font-size:0.85rem; }
  .body { padding:32px 30px; color:#374151; font-size:0.95rem; line-height:1.7; }
  .body p { margin:0 0 16px; }
  .content-box { background:#f0f7ff; border-left:4px solid #1e40af; padding:16px 20px; margin:20px 0; border-radius:4px; }
  .footer { background:#f9fafb; border-top:1px solid #e5e7eb; padding:18px 30px; text-align:center; color:#9ca3af; font-size:0.8rem; }
  .footer a { color:#1e40af; text-decoration:none; }
</style>
</head>
<body>
<div class="wrapper">
  <div class="header">
    <h1>&#127981; {$bankShort}</h1>
    <p>{$bankName}</p>
  </div>
  <div class="body">
    <p>Dear <strong>{$recipientName}</strong>,</p>
    {$content}
    <p>Warm regards,<br><strong>{$bankShort} Team</strong></p>
  </div>
  <div class="footer">
    {$footer}
    <p style="margin:8px 0 0;">&copy; {$year} {$bankName}. All rights reserved.</p>
  </div>
</div>
</body>
</html>
HTML;
}
?>
