<?php

return [
    'routes' => array(
        'index' => array(
            'type' => 'Zend\Mvc\Router\Http\Literal',
            'options' => array(
                'route' => '/',
                'defaults' => array(
                    'controller' => 'Application\Controller\Home',
                    'action' => 'index',
                ),
            ),
        ),
        'home' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/home[/:action]',
                'constraints' => array(
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                ),
                'defaults' => array(
                    'controller' => 'Application\Controller\Home',
                    'action' => 'index',
                ),
            ),
        ),
        'cliente' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/cliente[/:action][/:identificador]',
                'constraints' => array(
                    'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                    'identificador' => '[a-zA-Z0-9_-]+',
                ),
                'defaults' => array(
                    'controller' => 'Application\Controller\Cliente',
                    'action' => 'index',
                ),
            ),
        ),
        'imagem' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/image/:path[/:width][/]',
                'constraints' => array(
                    'width' => '[0-9][0-9]*'
                ),
                'defaults' => array(
                    'controller' => 'Application\Controller\Imagem',
                    'action' => 'index',
                ),
            ),
        ),
        'imagem-mini' => array(
            'type' => 'segment',
            'options' => array(
                'route' => '/image-mini/:path[/:width][/]',
                'constraints' => array(
                    'width' => '[0-9][0-9]*'
                ),
                'defaults' => array(
                    'controller' => 'Application\Controller\Imagem',
                    'action' => 'mini',
                ),
            ),
        ),
    ),
];
