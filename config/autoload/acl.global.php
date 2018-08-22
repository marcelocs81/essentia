<?php
return array(
    'acl' => array(
        'roles'     => array(
            'visitante' => null
        ),
        'resources' => array(
            'Application\Controller\Home.index',
            'Application\Controller\Cliente.index',
            'Application\Controller\Cliente.editar',
            'Application\Controller\Cliente.excluir',
        ),
        'privilege' => array(
            'visitante' => array(
                'allow' => array(
                    'Application\Controller\Home.index',
                    'Application\Controller\Cliente.index',
                    'Application\Controller\Cliente.editar',
                    'Application\Controller\Cliente.excluir',
                )
            ),
        )
    )
);