<?php
require_once '../PHPMailerAutoload.php';
 
$results_messages = array();
 
$mail = new PHPMailer(true);
$mail->CharSet = 'utf-8';
ini_set('default_charset', 'UTF-8');
 
class phpmailerAppException extends phpmailerException {}
 
try {
$to = 'diogenesdias@hotmail.com';
if(!PHPMailer::validateAddress($to)) {
  throw new phpmailerAppException("Email address " . $to . " is invalid -- aborting!");
}
$mail->isSMTP();
$mail->SMTPDebug  = 1;
$mail->Host       = "mail.host.com.br";
$mail->Port       = "25";
$mail->SMTPSecure = "tls";
$mail->SMTPAuth   = true;
$mail->Username   = "no-reply@host.com.br";
$mail->Password   = "sua senha";
$mail->addReplyTo("no-reply@host.com.br", "Nome da sua Empresa");
$mail->setFrom("no-reply@host.com.br", "Nome da sua Empresa");
$mail->addAddress("diogenesdias@hotmail.com", "Diógenes");
$mail->Subject  = "Teste (PHPMailer test using SMTP)";
$body = <<<'EOT'
Teste
EOT;
$mail->WordWrap = 78;
$mail->msgHTML($body, dirname(__FILE__), true); //Create message bodies and embed images
$mail->addAttachment('images/phpmailer_mini.png','phpmailer_mini.png');  // optional name
$mail->addAttachment('images/phpmailer.png', 'phpmailer.png');  // optional name
 
try {
  $mail->send();
  $results_messages[] = "Message has been sent using SMTP";
}
catch (phpmailerException $e) {
  throw new phpmailerAppException('Unable to send to: ' . $to. ': '.$e->getMessage());
}
}
catch (phpmailerAppException $e) {
  $results_messages[] = $e->errorMessage();
}
 
if (count($results_messages) > 0) {
  echo "<h2>Run results</h2>\n";
  echo "<ul>\n";
foreach ($results_messages as $result) {
  echo "<li>$result</li>\n";
}
echo "</ul>\n";
}