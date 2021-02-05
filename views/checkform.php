<?php
// Recaptchaa!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
$recaptcha_secret = RECAPTCHA_KEY; 
$recaptcha_response = $_POST['recaptcha_response']; 
$url = 'https://www.google.com/recaptcha/api/siteverify'; 

$data = array( 'secret' => $recaptcha_secret, 'response' => $recaptcha_response, 'remoteip' => $_SERVER['REMOTE_ADDR'] ); 
$curlConfig = array( CURLOPT_URL => $url, CURLOPT_POST => true, CURLOPT_RETURNTRANSFER => true, CURLOPT_POSTFIELDS => $data ); 
$ch = curl_init(); 
curl_setopt_array($ch, $curlConfig); 
$response = curl_exec($ch); 
curl_close($ch);

$jsonResponse = json_decode($response);
if ($jsonResponse->success === true) { 
    
    //======================================================================
    // PROCESAR FORMULARIO 
    //======================================================================
    // Comprobamos si nos llega los datos por POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        //-----------------------------------------------------
        // Variables
        //-----------------------------------------------------
        $errores = [];
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $apellido = isset($_POST['apellido']) ? $_POST['apellido'] : null;
        $msj = isset($_POST['msj']) ? $_POST['msj'] : null;
        $dni = isset($_POST['dni']) ? $_POST['dni'] : null;
        $tel = isset($_POST['tel']) ? $_POST['tel'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;

        //-----------------------------------------------------
        // Validaciones
        //-----------------------------------------------------
        // Nombre
        if (!validar_requerido($nombre)) {
            $errores[] = 'El campo Nombre es obligatorio.';
        }
        // Apellido
        if (!validar_requerido($apellido)) {
            $errores[] = 'El campo Apellido es obligatorio.';
        }
        // DNI
        if (!validar_entero($dni)) {
            $errores[] = 'El campo de DNI debe ser un número.';
        }
        // Email
        if (!validar_email($email)) {
            $errores[] = 'El campo de Email tiene un formato no válido.';
        }
        // Mensaje
        if (!validar_requerido($msj)) {
            $errores[] = 'El campo Mensaje es obligatorio.';
        }
        // convierto post en session
        $_SESSION = $_POST;
    }
    
    // Mostramos errores por HTML

    if (isset($errores)): ?>
    
        <ul class="errores">

        <?php foreach ($errores as $error) {
        echo '<li>' . $error . '</li>';
        echo "<script>window.location.replace('http://salideveraz.com.ar/error');</script>";

    } ?> 
    
    </ul>
    <?php endif; 
    echo "<script>window.location.replace('http://salideveraz.com.ar/success');</script>";
}