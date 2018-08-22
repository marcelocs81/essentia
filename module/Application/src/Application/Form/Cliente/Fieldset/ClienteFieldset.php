<?php

namespace Application\Form\Cliente\Fieldset;

use Application\Entity\Cliente;
use Application\Entity\Estabelecimento;
use Application\Entity\Regiao;
use Application\Form\Cliente\InputFilter\ConsultaInputFilter;
use Application\Form\Cliente\InputFilter\ClienteInputFilter;
use Application\PickList\StatusPickList;
use Application\PickList\TipoClientePickList;
use Application\ValueObject\FiltroCliente;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ClienteFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * init method
     */
    public function init()
    {

        parent::__construct('cliente-fieldset');

        $this->add(
            [
                'name'       => 'id',
                'attributes' => [
                    'type' => 'hidden',
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'nome',
                'type'       => 'text',
                'options'    => [
                    'label'            => 'Nome',
                    'label_attributes' => [
                        'class' => 'required'
                    ],
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'class' => 'form-control col-xs-12',
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'email',
                'type'       => 'text',
                'options'    => [
                    'label'            => 'E-mail',
                    'label_attributes' => [
                        'class' => 'required'
                    ],
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'class' => 'form-control col-xs-12',
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'telefone',
                'type'       => 'text',
                'options'    => [
                    'label' => 'Telefone',
                    'label_attributes' => [
                        'class' => 'required'
                    ],
                ],
                'attributes' => [
                    'type'        => 'text',
                    'placeholder' => '(__) ____-____',
                    'class'       => 'form-control input-sm telefone-mask',
                    'id'          => 'telefone'
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'tipo',
                'type'       => 'Select',
                'options'    => [
                    'label'         => 'Tipo',
                    'empty_option'  => 'Selecione',
                    'value_options' => TipoClientePickList::getArray()
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'class' => 'form-control col-xs-12'
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'cpfCnpj',
                'type'       => 'Text',
                'options'    => [
                    'label' => 'CPF/CNPJ:'
                ],
                'attributes' => [
                    'type'        => 'text',
                    'placeholder' => '',
                    'class'       => 'form-control input-xs',
                    'style'       => 'width: 100%'
                ],
            ]
        );

        $this->add(
            [
                'name'       => 'regiao',
                'type'       => 'Application\Form\Element\ObjectSelect',
                'options'    => [
                    'value_property'   => 'id',
                    'label'            => 'Região',
                    'label_attributes' => [
                        'class' => ''
                    ],
                    'empty_option'     => 'Selecione',
                    'target_class'     => Regiao::class,
                    'label_generator'  => function (Regiao $cliente) {
                        return $cliente->getNome();
                    },
                    'is_method'          => true,
                    'find_method'        => [
                        'name'   => 'findBy',
                        'params' => [
                            'criteria' => [],
                            'orderBy'  => ['nome' => 'ASC'],
                        ],
                    ]
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'id'    => 'select-regiao',
                    'class' => 'form-control',
                ]
            ]
        );

        $this->add(
            [
                'name'    => 'ativo',
                'type'    => 'checkbox',
                'options' => [
                    'label'              => 'Cliente Ativo',
                    'use_hidden_element' => true,
                    'checked_value'      => true,
                    'unchecked_value'    => false,
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'fotoFile',
                'type'       => 'File',
                'options'    => [
                    'label'            => 'Foto',
                    'label_attributes' => [
                        'class' => 'required'
                    ],
                ],
                'attributes' => [
                    'class' => 'form-control input-sm',
                ],
            ]
        );

    }

    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return ['type' => ClienteInputFilter::class];
    }
}
