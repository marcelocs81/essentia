<?php

/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(

    'module_layouts' => array(
        'Application' => 'layout/layout',
        'Extranet' => 'layout/cliente',
    ),
    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Db\Adapter\AdapterAbstractServiceFactory',
        ),
        'factories' => array(
            'Zend\Db\Adapter\Adapter' => 'Application\Factory\ZendDbAdapterFactory'
        ),
    ),

    'session' => array(
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'ESSENTIA',
            ),
        ),
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        )
    ),

    'slm_locale' => [
        'default' => 'pt_BR',
        'supported' => ['pt_BR'],
        'strategies' => ['query', 'cookie', 'acceptlanguage']
    ]
);
