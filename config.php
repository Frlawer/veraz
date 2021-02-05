<?php
/*
  |--------------------------------------------------------------------------
  | En este array se ponen todas las vistas permitidas, sin el .php
  |--------------------------------------------------------------------------
  | Las vistas son archivos que vas a incluir en cada seccion de tu app.
  | Por ejemplo Home, Quienes Somos, Ayuda, etc. etc...
 */
$arr = array('inicio','informes','mp_veraz','success','checkform','error');
/*
  |--------------------------------------------------------------------------
  | Si queres mostrar errores de php en pantalla, ponela en SI sino en NO
  |--------------------------------------------------------------------------
  |
 */
define('MOSTRAR_ERRORES', 'SI');//SI ó NO

/*
  |--------------------------------------------------------------------------
  | Nombre de la Empresa.
  |--------------------------------------------------------------------------
  |
 */
define('NAME_SITE','Salí de Veraz');

/*
  |--------------------------------------------------------------------------
  | Esta es la base url de la app, fuera de facebook, osea la del dominio.
  |--------------------------------------------------------------------------
  |
 */
define('BASE_PATH', dirname(__FILE__));
define('BASE_URL','http://salideveraz.com.ar/');

/*
  |--------------------------------------------------------------------------
  | Clave Recaptcha.
  |--------------------------------------------------------------------------
  |
 */
define('RECAPTCHA_KEY','6LeV4z8aAAAAANxuwSAGr2W0MfE4ZDnEqpgYWKny');

/*
  |--------------------------------------------------------------------------
  | Ruta del servidor de las vistas
  |--------------------------------------------------------------------------
  |
 */
define("RUTA_VISTAS",getcwd().DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR);

/*
  |--------------------------------------------------------------------------
  | Token mp 
  |--------------------------------------------------------------------------
  |
 */
define("TOKEN_MP", 'TEST-3ba5264a-4351-46bc-a78c-4f3148158db0');


/**
 * Get instance of DB object
 */
define(DB_HOST, 'localhost');
define(DB_USER, 'c2070639_veraz');
define(DB_PASSWORD, 'me40sokaNU');
define(DB_NAME, 'c2070639_veraz');