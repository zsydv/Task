<?php

use PHPMailer\PHPMailer\PHPMailer;

class EmailSender
{
    public function sendEmail($subject, $recipient, $message)
    {
        try {
            $mail = new PHPMailer(true);
            $mail->IsSMTP();
            $mail->SMTPAuth = false;
            $mail->Host = 'localhost';
            $mail->Port = 1025;

            $mail->CharSet = 'UTF-8';
            $mail->SetFrom('zeyidova@mail.ru', 'Zeyneb');
            $mail->AddAddress($recipient);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->Send();
            $mail->SMTPDebug = 2;
            return true;
        } catch (Exception $e) {
            echo "E-posta gönderme hatası: " . $e->getMessage();
            return false;
        }
    }


   public function sendSupportEmail($name, $surname, $email, $phone) {
        try {
           
            $mailDefault = new PHPMailer(true);
            $mailDefault->IsSMTP();
            $mailDefault->SMTPAuth = true; 
            $mailDefault->SMTPSecure = 'tls';
            $mailDefault->Host = 'smtp.mail.ru';
            $mailDefault->Port = 587;
            $mailDefault->Username = ''; //smtp mail username
            $mailDefault->Password = ''; // smtp mail password
        
            $mailDefault->CharSet = 'UTF-8';
            $mailDefault->SetFrom('zeyidova@mail.ru', 'Zeyneb');
            $mailDefault->AddAddress(''); // support@era.az
            $mailDefault->Subject = 'Yeni istifadəçi qeydiyyatı:';
            $messageDefault = '<table border="1" cellpadding="5" cellspacing="0">';
            $messageDefault .= '<tr><td><b>Ad</b></td><td>' . $name . '</td></tr>';
            $messageDefault .= '<tr><td><b>Soyad</b></td><td>' . $surname . '</td></tr>';
            $messageDefault .= '<tr><td><b>Email</b></td><td>' . $email . '</td></tr>';
            $messageDefault .= '<tr><td><b>Telefon</b></td><td>' . $phone . '</td></tr>';
            $messageDefault .= '</table>';
            $mailDefault->IsHTML(true);
            $mailDefault->Body = $messageDefault;
        
            $mailDefault->Send();
            $mailDefault->SMTPDebug = 2;
        
        } catch (Exception $e) {
            echo "E-mail göndərmə xətası: " . $e->getMessage();
        }
}

}
