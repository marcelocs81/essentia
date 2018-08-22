<?php

if (array_key_exists('argc', $_SERVER) && $_SERVER['argc'] > 0) {
    $path = realpath(__DIR__ . DIRECTORY_SEPARATOR . '..');
    include_once $path . '/env.config.php';
    include_once($path . '/define' . DIRECTORY_SEPARATOR . AMBIENTE . '.php');
}

return array(
    'db'       => array(
        'driver'         => 'Pdo',
        'username'       => ENV_DB_USER,
        'password'       => ENV_DB_PASSWORD,
        'dsn'            => 'mysql:dbname=' . ENV_DB_NAME . ';host=' . ENV_DB_HOST,
        'driver_options' => array(
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET \'UTF8\''
        ),
    ),
    'doctrine' => [
        'configuration' => [
            'orm_default' => [
                'metadata_cache'   => ENV_TYPE_CACHE_DOCTRINE,
                'query_cache'      => ENV_TYPE_CACHE_DOCTRINE,
                'result_cache'     => ENV_TYPE_CACHE_DOCTRINE,
                'hydration_cache'  => ENV_TYPE_CACHE_DOCTRINE,
                'generate_proxies' => ENV_GENERATE_ENTITIES,
                'filters'          => [
                    'soft_delete' => 'Gedmo\SoftDeleteable\Filter\SoftDeleteableFilter'
                ],
            ]
        ],
        'connection'    => [
            'orm_default' => [
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params'      => [
                    'host'          => ENV_DB_HOST,
                    'port'          => '3306',
                    'user'          => ENV_DB_USER,
                    'password'      => ENV_DB_PASSWORD,
                    'dbname'        => ENV_DB_NAME,
                    'driverOptions' => [
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
                    ]
                ]
            ]
        ],
        'eventmanager'  => array(
            'orm_default' => array(
                'subscribers' => array(
                    'Gedmo\Timestampable\TimestampableListener',
                    'Gedmo\Sluggable\SluggableListener',
                    'Gedmo\SoftDeleteable\SoftDeleteableListener'
                ),
            ),
        ),
        'driver'        => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => ENV_TYPE_CACHE_DOCTRINE,
            ),
            'orm_default'          => array(
                'drivers' => array()
            )
        ),
        'cache'         => [
            'apc' => [
                'namespace' => 'essentia',
            ],
        ],
    ]
);
