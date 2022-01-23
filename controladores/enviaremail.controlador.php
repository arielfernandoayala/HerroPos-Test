<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

// Load Composer's autoloader  SOLO SI INSTALAMOS PHPMAILER DESD COMPOSER
//require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

class enviarEmail{



	static public function ctrEnviarEmail(){



    try {
 
        $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
        )
    );
    //Server settings
    $mail->SMTPDebug = 2;                      // Enable verbose debug output //0 NO MUESTRA NADA / 2 MUESTRA TODO
    $mail->isSMTP();                                            // Send using SMTP (Protocolo)
    $mail->Host       = 'c0220019.ferozo.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'cliente@encasade-herrero.com';                     // SMTP username
    $mail->Password   = 'Ranger2011';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('cliente@encasade-herrero.com', 'Pedido de presupuesto');
    $mail->addAddress("presupuestos@encasade-herrero.com", 'Presupuesto');     // Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Pedido presupuesto';
    $mail->Body    = 'Email cliente: '.$_POST["ordPresupEmail"].'<br>Fecha:'.$_POST["ordPresupEmail"].'<br>Detalle: <br>'.$_POST["ordPresupDetalle"].'<br>';
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Mensaje enviado';
    }catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    };

   }
}



/*
<script> 
  function r() { window.location = "ordenpresup"; } 
  setTimeout ("r()", 15000);
</script>
*/


