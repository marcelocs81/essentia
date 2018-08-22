<?php

return [
    'invokables' => array(
        'Application\Controller\Home' => 'Application\Controller\HomeController',
        'Application\Controller\Download' => 'Application\Controller\DownloadController',
        'Application\Controller\Imagem' => 'Application\Controller\ImagemController',
    ),
    'factories' => array(
        'Application\Controller\Cliente' => 'Application\Controller\Factory\ClienteControllerFactory',
    ),
];