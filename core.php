<?php

/*
  |--------------------------------------------------------------------------
  | Restringir las vistas a incluir
  |--------------------------------------------------------------------------
  |
 */

function url_permitidas($view, $arr) {

    if (in_array($view, $arr) AND file_exists(RUTA_VISTAS . $view . '.php')) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function getDbInstance() {
	return new MysqliDb(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
}

 //-----------------------------------------------------
// Funciones Para Validar
//-----------------------------------------------------

/**
 * Método que valida si un texto no esta vacío
 * @param {string} - Texto a validar
 * @return {boolean}
 */
function validar_requerido(string $texto): bool
{
    return !(trim($texto) == '');
}

/**
 * Método que valida si es un número entero 
 * @param {string} - Número a validar
 * @return {bool}
 */
function validar_entero(string $numero): bool
{
    return (filter_var($numero, FILTER_VALIDATE_INT) === FALSE) ? False : True;
}

/**
 * Método que valida si el texto tiene un formato válido de E-Mail
 * @param {string} - Email
 * @return {bool}
 */
function validar_email(string $texto): bool
{
    return (filter_var($texto, FILTER_VALIDATE_EMAIL) === FALSE) ? False : True;
}
