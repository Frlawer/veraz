<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
// use thingengineer\MysqliDb\MysqliDb;
    require './vendor/autoload.php';
    // require 'mail/Exception.php';
    // require 'mail/PHPMailer.php';
    // require 'mail/SMTP.php';
// require_once ('/vendor/thigengineer/MysqliDb.php');
// require_once BASE_PATH . '/admin/lib/MysqliDb/MysqliDb.php';

// Código para procesar el formulario
if (array_key_exists('email', $_SESSION)) {
    

    // seteo las session
    
    $nombre = $_SESSION['nombre'];
    $apellido = $_SESSION['apellido'];
    $dni = $_SESSION['dni'];
    $tel = $_SESSION['tel'];
    $email = $_SESSION['email'];
    $msj = $_SESSION['msj'];
    
    $cliente = getDbInstance();
    $data = Array (
        "cliente_nombre" => $nombre,
        "cliente_apellido" => $apellido,
        "cliente_dni" => $dni,
        "cliente_tel" => $tel,
        "cliente_email" => $email,
        "cliente_msj" => $msj
    );
    $data['createdAt'] = date('Y-m-d H:i:s');
    $id = $cliente->insert ('cliente', $data);

    // email para Eli

    $mail = new PHPMailer;

    $mail->CharSet = 'UTF-8';
    $mail->setFrom('hola@salideveraz.com.ar', NAME_SITE);
    $mail->addAddress('hola@salideveraz.com.ar');
    $mail->Subject = 'Nueva solicitud de Informe.';
    $mail->isHTML(true);
    $mail->Body = '<p>El cliente '.$nombre.' '.$apellido.' solicitó un informe.</p><p>Datos del cliente: <pre>Email: '.$email.',</pre> <pre>Telefono: '.$tel.',</pre> <pre>Mensaje: '.$msj.'</pre></p>';
    
    if(!$mail->send()){
        echo 'Error: '.$mail->ErrorInfo;
        echo '<div class="wrapper"><div class="container"><div class="row"><div class="msj-ok"><h2>Email a Eli falló</a></h2><div class="button text-right "><a href="/" class="scrolly">Volver a inicio</a></div></div></div></div></div>';
    }
    
    // email a cliente
    $mail2 = new PHPMailer;
    
    $mail2  ->CharSet = 'UTF-8';
    $mail2->setFrom('hola@salideveraz.com.ar', NAME_SITE);
    $mail2->addAddress($email);
    $mail2->isHTML(true);
    $mail2->Subject = 'Solicitaste un informe en ' . NAME_SITE;
    $mail2->Body = '<h1 style="text-align:center">Informe en '.NAME_SITE.'</h1><h2>¡Acabas de solicitar un informe Veraz en SalideVeraz.com.ar!</h2><p>Los pasos a seguir son los siguientes:</p><p>Si recibiste este email a continuación debes abonar el informe a través de una transferencia a CBU: . En cualquier situación que no sea posible realizar la misma nos pondremos en contacto con ud. para informar otros metodos de pago.</p>';
    $mail2->Body .= '<p>Si usted no solicitó una cita envienos un email a <a href="mailto:hola@salideveraz.com.ar">hola@salideveraz.com.ar</a>.</p><pre style="text-align:center">© 2021 '.NAME_SITE.' Todos los derechos reservados</pre>';
    
    if(!$mail2->send()){
        echo 'Error2: '.$mail2->ErrorInfo;
    }

} 
?>

<section class="wrapper style1 align-center">
    <div class="inner">
        <h2>Recibimos tu solicitud de informe.</h2>
        <div class=" style2 medium onscroll-fade-in">
            <section>
                <p>Debes revisar tu Email donde te enviamos información de como continuar el procedimiento</p>
                <p>Pronto nos pondremos en contacto contigo.</p>
                <p>Gracias por confiar en Eli te saca de Veraz.</p>
                <a href="/" class="button">Volver a inicio.</a>
            </section>
        </div>
    </div>
</section>