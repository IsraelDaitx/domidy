<?php
/**
 * DOMIDY SAAS - Configurações principais
 */

// URLs
define('BASE_URL', 'http://localhost/domidy');
define('API_URL', BASE_URL . '/api');

// Banco de dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'domidy');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHARSET', 'utf8mb4');

// Segurança
define('SESSION_TIMEOUT', 3600); // 1 hora
define('PASSWORD_HASH_ALGO', PASSWORD_BCRYPT);

// WhatsApp
define('WHATSAPP_API_KEY', 'SUA_CHAVE_API');
define('WHATSAPP_WEBHOOK_TOKEN', 'token_verificacao');

// Pix / Pagamentos
define('PIX_KEY', 'sua_chave_pix@email.com');
define('MERCADO_PAGO_TOKEN', 'seu_token_mp');

// Modo desenvolvimento
define('DEV_MODE', true);

if (DEV_MODE) {
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
} else {
    ini_set('display_errors', 0);
    error_reporting(0);
}

// Timezone
date_default_timezone_set('America/Sao_Paulo');
?>
