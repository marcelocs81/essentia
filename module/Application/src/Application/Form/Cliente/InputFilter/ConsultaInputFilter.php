<?php

namespace Application\Form\Cliente\InputFilter;

use Application\InputFilter\Extension\CustomizedInputFilter;
use Zend\Filter\Null;

class ConsultaInputFilter extends CustomizedInputFilter
{
    public function init()
    {

        $this->add(
            [
                'name' => 'ativo',
                'required' => false,
                'validators' => [

                ],
                'filters' => [
                    [
                        'name' => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
                        ]
                    ],
                    ['name' => 'Boolean']
                ],
            ]
        );

        $this->add(
            [
                'name' => 'nome',
                'required' => false,
                'filters' => [
                    [
                        'name' => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
                        ]
                    ]
                ]
            ]
        );

        $this->add(
            [
                'name' => 'email',
                'required' => false,
                'filters' => [
                    [
                        'name' => 'Null',
                        'options' => [
                            'type' => [Null::TYPE_STRING]
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
                    ['name' => 'Int'],
                    ['name' => 'Null']
                ]
            ]
        );

    }
}