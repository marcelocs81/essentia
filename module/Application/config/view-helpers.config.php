<?php

use Application\View\Helper\GetNumberOrUninformedToCurrentLocale;
use \Application\View\Helper\Factory\GetDateOrUninformedToCurrentLocaleFactory;

return [

    'factories' => [
        'Application\View\Helper\AlertMessage' => 'Application\View\Helper\Factory\AlertMessageFactory',
        'getDateOrUninformedToCurrentLocale'   => GetDateOrUninformedToCurrentLocaleFactory::class,
    ],

    'aliases' => [
        'alertMessage' => 'Application\View\Helper\AlertMessage',
    ],

    'invokables' => [
        'config'                               => 'Application\View\Helper\Config',
    ],
];