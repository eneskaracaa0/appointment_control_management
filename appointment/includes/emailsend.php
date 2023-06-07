<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail=new PHPMailer();

$mail->isSMTP();
$mail->SMTPKeepAlive=true;
$mail->SMTPAuth=true;
$mail->SMTPSecure='ssl';

$mail->Port=587;
$mail->Host='smtp.gmail.com';

$mail->Username='eneskaraca18.ek@gmail.com';
$mail->Password='Kjl5pqajl3252';

$mail->setFrom($mail->Username,'Enes Karaca');
$mail->addAddress('eneskaraca18.ek@gmail.com', 'enes karaca');

$mail->isHTML(isHtml:true);
$mail->Subject='Randevu Hatırlatma';
$mail->Body='bu bir denemedir';

if($mail->send()){
    echo 'mail gönderimi başarılı';
}else{
    echo 'hata oluştu';
}
?>