<?php
/**
 * Created by PhpStorm.
 * User: Marcelo C. de Souza
 *
 * Neste arquivo devem ser definidas as constantes que variam de acordo com cada ambiente
 * O virtualHost deve conter o atributo 'SetEnv APPLICATION_ENV "homologation"',
 *      sendo o vaor definido no APPLICATION_ENV determina o arquivo a ser incluido e caso não encontre é carregado o arquivo default.php
 *
 */
//'udo'           => '357375',
ini_set("soap.wsdl_cache_enabled", 1);
ini_set('soap.wsdl_cache_dir', BASE_PATH . '/data/cache');
ini_set('default_socket_timeout', 720);
ini_set('max_execution_time', 0);
ini_set('memory_limit', '200M');
ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '10M');

define('ENV_DEBUG', true);

define('ENV_BASE_URL', '//essentia.localhost');

$vars = parse_ini_file('version.ini');
$version = $vars['version'];
define('VERSAO_ATUALIZACAO', $version); // Esta constante é utilizada para forçar a atualização dos arquivos css e javascript no servidor de produção.

/**
 * Esta constante foi construída para resolver um problema de configurações de rota dos diferentes ambientes.
 * Se o ambiente estiver com a opção para validar as rotas TRUE, então o menu será validado e caso não encontre alguma rota
 * no arquivo de configurações a mesma será substituída pela padrão HOME.
 *
 * Caso contrário, os menus não serão validados, com isso, caso não encontre a rota, um erro será exibido, padrão do framework.
 */
define('VALIDATE_ROUTES', true);

define('ENV_DB_HOST',       '127.0.0.1');
define('ENV_DB_NAME',       'essentia');
define('ENV_DB_USER',       'root');
define('ENV_DB_PASSWORD',   '');

define('ENV_ENABLE_CACHE_ZF', true);
define('ENV_ENABLE_MODULE_MAP_CACHE_ZF', true);
define('ENV_CACHE_DIR', 'data/cache');

define('ENV_TYPE_CACHE_DOCTRINE', 'array');
define('ENV_GENERATE_ENTITIES', true);

define('ENV_CMD_DEL_FILE', 'del /F /Q ');

define('ENV_USER_CONSOLE', 1);