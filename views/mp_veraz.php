<?php
session_start();
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
	
// MERCADOPAGO !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

// curl -X POST -H "Content-Type: application/json" -H "Authorization: Bearer TEST-5503571218052849-112616-65aa2d57f976a8ee270c33da123e129c-225380343" "https://api.mercadopago.com/users/test_user" -d "{'site_id':'MLA'}"

// Eli 1 {"id":678313240,"nickname":"TEST6NYR7XP9","password":"qatest5802","site_status":"active","email":"test_user_55739071@testuser.com"}
// TEST-3ba5264a-4351-46bc-a78c-4f3148158db0
// TEST-7859083094183615-112618-bc6769d4071f027497af557d99d66374-678313240

// Cliente 2 {"id":678312087,"nickname":"TESTMF3EZEVE","password":"qatest948","site_status":"active","email":"test_user_36139729@testuser.com"}
// TEST-821d05fe-57b0-46d0-8ce6-c4c893e0f21f
// TEST-3123934908189135-112715-8d504a0f221e5bfb774879b84c8a6860-678312087

// Cliente 3 {"id":678785608,"nickname":"TESTHMPYM33R","password":"qatest7164","site_status":"active","email":"test_user_40346407@testuser.com"}
// TEST-3a7eaf31-4270-40e2-8424-a85979a14738
// TEST-6679619872367298-112715-1371d4b19250f77de038505d47fd9917-678785608


// Eli {"id":678788760,"nickname":"TETE7062388","password":"qatest5793","site_status":"active","email":"test_user_21643094@testuser.com"}

// Tarjetas
// Mastercard	5031755734530604	123	11/25
// Visa	4509953566233704 123	11/25
// American Express	371180303257522	1234	11/25

// success?
// collection_id=1231668602
// collection_status=approved
// payment_id=1231668602
// status=approved
// external_reference=null
// payment_type=credit_card
// merchant_order_id=2041956958
// preference_id=678313240-2e1fa95a-a4b3-4b79-a35b-f1ad7b3800e3
// site_id=MLA
// processing_mode=aggregator
// merchant_account_id=null

// APRO: Pago aprobado.
// CONT: Pago pendiente.
// OTHE: Rechazado por error general.
// CALL: Rechazado con validación para autorizar.
// FUND: Rechazado por monto insuficiente.
// SECU: Rechazado por código de seguridad inválido.
// EXPI: Rechazado por problema con la fecha de expiración.
// FORM: Rechazado por error en formulario

	// reviso si post esta vacio
	if (empty($_POST))  {
		echo "<script>window.location.replace('http://salideveraz.com.ar/informes');</script>";
	}
	// convierto post en session
	$_SESSION = $_POST;
	// SDK de Mercado Pago
	require_once './vendor/autoload.php';

	// separo los datos
	$token_veraz = TOKEN_MP;

	// Agrega credenciales
	MercadoPago\SDK::setAccessToken($token_veraz);

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
} ?>
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