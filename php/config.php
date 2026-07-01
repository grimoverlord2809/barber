<?php
/**
 * Configurações do Banco de Dados
 * Barbearia Premium
 */

// Configurações de conexão
define('DB_HOST', 'localhost');
define('DB_NAME', 'barbearia');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Configurações gerais
define('SITE_NAME', 'Barber Book');
define('SITE_URL', 'http://localhost/bar');
define('WHATSAPP_NUMBER', '5586999504284');

// Configurações de timezone
date_default_timezone_set('America/Sao_Paulo');

// Modo de depuração
define('DEBUG_MODE', true);

if (DEBUG_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
