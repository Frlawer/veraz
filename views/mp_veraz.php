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

	// reviso si post esta vacio
	if (empty($_POST))  {
		echo "<script>window.location.replace('http://salideveraz.com.ar/cita');</script>";
	}
	// convierto post en session
	$_SESSION = $_POST;
	// llamo a las clases
	require_once('./clases/area.php');
	require_once('./clases/cita.php');
	require_once('./clases/abogada.php');
										
	// creo el objeto abogada para tomar datos
	$mp = new Abogada();
	// pido datos de token
	$mp->mpAbogada($_SESSION['abogada']);
	$datos_mp = $mp->rows;

	// SDK de Mercado Pago
	require './vendor/autoload.php';

	// separo los datos
	$token_rejtman = $datos_mp[0]['mp_token_secure'];

	// Agrega credenciales
	MercadoPago\SDK::setAccessToken($token_rejtman);

	// Crea un objeto de preferencia
	$preference = new MercadoPago\Preference();
	$preference->back_urls = array(
		"success" => "http://salideveraz.com.ar/success",
		"failure" => "http://salideveraz.com.ar/failure",
		"pending" => "http://salideveraz.com.ar/pending"
	);
	$preference->auto_return = "approved";

	$preference->payment_methods = array(
		"excluded_payment_types" => array(
			array("id" => "ticket")
		),
		"installments" => 3
		);

	$datos = array();
	for($x=0;$x<1;$x++){
		$item = new MercadoPago\Item();
		$item->title = 'Informe Veraz';
		$item->quantity = 1;
		$item->unit_price = 3200;
		$item->description = "Solicitud de informe Veraz Equifax.";
		$item->category_id = "service";
		$datos[] = $item;
	}

	$preference->items = $datos;

	$preference->save();
}
?>
<div class="contactarea wrapper" id="contactarea">
	<article class="container special">
		<header>
			<h2>Abonar el Informe de Veraz.</h2>
			<p>Para poder solicitar el informe es necesario abonar el mismo a través de MercadoPago. Recibimos débito, credito y pagos con tu cuenta de MP.</p>
		</header>
		<div class="col-12" id="mp-img">
			<img src="https://imgmp.mlstatic.com/org-img/banners/ar/medios/online/468X60.jpg" title="Mercado Pago - Medios de pago" alt="Mercado Pago - Medios de pago" width="468"/>
		</div>
		<footer>
			<a href="<?php echo $preference->init_point; ?>" class="button">
					Abonar la cita por Mercado Pago
			</a>
		</footer>
	</article>
</div>