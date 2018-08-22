<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'owner'           => 'Essentia',
    'copyright'       => 'Desenvolvido por Marcelo Cardoso de Souza',
    'version'         => 'versão 1.0',
    'controllers'     => include 'controllers.config.php',
    'view_helpers'    => include 'view-helpers.config.php',
    'input_filters'   => include 'input-filters.config.php',
    'router'          => include 'routes.config.php',
    'form_elements'   => include 'form-elements.config.php',
    'service_manager' => include 'services.config.php',
    'validators'      => include 'validators.config.php',
    'filters'         => include 'filters.config.php',
    'translator'      => array(
        'locale'                    => 'pt_BR',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'view_manager'    => include 'view-manager.config.php',
    'doctrine'        => array(
        'driver' => array(
            'application_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Application/Entity')
            ),
            'orm_default'          => array(
                'drivers' => array(
                    'Application\Entity' => 'application_entities',
                )
            )
        )
    ),

);
