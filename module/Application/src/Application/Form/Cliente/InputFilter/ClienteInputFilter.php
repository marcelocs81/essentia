<?php

namespace Application\Form\Cliente\InputFilter;

use Application\Entity\Cliente;
use Application\Filter\File\MkdirRenameUpload;
use Application\InputFilter\Extension\CustomizedInputFilter;
use Zend\Filter\Null;

class ClienteInputFilter extends CustomizedInputFilter
{
    public function init()
    {

        $this->add(
            [
                'name'       => 'ativo',
                'required'   => false,
                'validators' => [

                ],
                'filters'    => [
                    ['name' => 'Boolean']
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'nome',
                'required'   => true,
                'filters'    => [
                    [
                        'name'    => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
                        ]
                    ]
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'max' => 150
                        ]
                    ]
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'email',
                'required'   => true,
                'filters'    => [
                    [
                        'name'    => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
                        ]
                    ]
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'max' => 150
                        ]
                    ]
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'telefone',
                'required'   => true,
                'filters'    => [
                    [
                        'name'    => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
                        ]
                    ]
                ],
                'validators' => [
                    [
                        'name'    => 'StringLength',
                        'options' => [
                            'max' => 45
                        ]
                    ]
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'regiao',
                'required'   => false,
                'validators' => [
                    ['name' => 'NotEmpty'],
                ],
                'filters'    => [
//                    ['name' => 'Int'],
                    ['name' => 'Null']
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'tipo',
                'required'   => false,
                'validators' => [
                    ['name' => 'NotEmpty'],
                ],
                'filters'    => [
                    [
                        'name'    => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
                        ]
                    ]
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'fotoFile',
                'type'       => 'Zend\InputFilter\FileInput',
                'required'   => true,
                'filters'    => [
                    [
                        'name'    => MkdirRenameUpload::class,
                        'options' => [
                            'target'               => Cliente::PATH,
                            'randomize'            => true,
                            'use_upload_extension' => true,
                            'use_upload_name'      => true
                        ],

                    ],

                ],
                'validators' => [
                    [
                        'name'    => 'filesize',
                        'options' => [
                            'max'     => Cliente::SIZE_FOTO,
                            'message' => 'Tamanho máximo de upload: ' . Cliente::SIZE_FOTO
                        ]
                    ],
                    [
                        'name'    => 'fileextension',
                        'options' => [
                            'extension' => Cliente::EXTENSION_FOTO,
                            'message'   => 'Formato não suportado.'
                        ]
                    ]
                ]
            ]
        );

    }
}