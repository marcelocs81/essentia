<?php

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir(dirname(__DIR__));

$protocol = isset($_SERVER['REQUEST_SCHEME']) ? $_SERVER['REQUEST_SCHEME'] : 'http';
$alias = isset($_SERVER['REDIRECT_BASE']) ?  substr_replace($_SERVER['REDIRECT_BASE'], '', -1) : null;

if(array_key_exists('argc', $_SERVER) && $_SERVER['argc'] > 0){
    define('BASE_URL', 'console' );
}else{
    define('BASE_URL', sprintf('%s://%s%s', $protocol, $_SERVER['HTTP_HOST'], $alias));
}

define('BASE_PATH', realpath(__DIR__ . DIRECTORY_SEPARATOR . '..'));
define('DS', DIRECTORY_SEPARATOR);

/**
 * Constantes criadas para se saber qual ambiente foi definido no arquivo env.config.php
 */
define('ENV_LOCALHOST',       'localhost');
define('ENV_DEMONSTRACAO',    'demonstration');
define('ENV_DESENVOLVIMENTO', 'development');
define('ENV_HOMOLOGACAO',     'homologation');
define('ENV_PRODUCAO',        'production');

include BASE_PATH . '/config/env.config.php';

if(! defined('AMBIENTE') || (
        AMBIENTE != ENV_PRODUCAO
        && AMBIENTE != ENV_DESENVOLVIMENTO
        && AMBIENTE != ENV_HOMOLOGACAO
        && AMBIENTE != ENV_LOCALHOST
        && AMBIENTE != ENV_DEMONSTRACAO
    )
    || ! file_exists( BASE_PATH . '/config/define/'.AMBIENTE.'.php')
){
    die('Variavel de ambiente nao foi definida ou arquivo de configuracoes nao foi encontrado.');
}

include BASE_PATH . '/config/define/'.AMBIENTE.'.php';

if(ENV_DEBUG){
    ini_set('apc.enabled', 0);
    ini_set('opcache.enable', 0);
    ini_set('display_errors', 1);
    ini_set('memory_limit', -1);
}else{
    ini_set('display_errors', 0);
    ini_set('memory_limit', '512M');
}

ini_set('xdebug.max_nesting_level', 200);

ini_set('max_input_nesting_level', 500);
date_default_timezone_set('America/Sao_Paulo');

error_reporting(E_ALL ^ E_STRICT);

// Decline static file requests back to the PHP built-in webserver
if (php_sapi_name() === 'cli-server' && is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
