<?php


return [
    'factories'          => array(
        'Application\Service\Search'                      => 'Application\Service\Factory\SearchFactory',
        'Session'                                         => 'Application\Factory\SessionFactory',
        'Application\Service\ClienteService'              => 'Application\Service\Factory\ClienteServiceFactory',
        'Application\Service\CommonService'               => 'Application\Service\Factory\CommonServiceFactory',
    ),
    'invokables'         => array(
    ),
    'abstract_factories' => array(
        'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
        'Zend\Log\LoggerAbstractServiceFactory',
    ),
    'aliases'            => array(
        'translator' => 'MvcTranslator',
    ),
];