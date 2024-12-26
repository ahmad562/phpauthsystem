<?php
// function sendEmail($to, $subject, $body) {
//     require_once 'phpmailer/src/PHPMailer.php';

//     $mail = new PHPMailer;
//     $mail->isSMTP();
//     $mail->Host = 'smtp.elasticemail.com'; 
//     $mail->SMTPAuth = true;
//     $mail->Username = 'support@fieldhippo.com';
//     $mail->Password = '0474EE6E6BC39622C8FFD168F8C8C59D5AEF';
//     $mail->SMTPSecure = 'tls';
//     $mail->Port = 5225;

//     $mail->setFrom('support@fieldhippo.com', 'Waqas Ahmad');
//     $mail->addAddress($to);

//     $mail->isHTML(true);
//     $mail->Subject = $subject;
//     $mail->Body    = $body;

//     return $mail->send();
// }

function sendEmail($to, $subject, $body) {
    $headers = "From: your_email@example.com\r\n";
    $headers .= "Reply-To: your_email@example.com\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    return mail($to, $subject, $body, $headers);
}
?>