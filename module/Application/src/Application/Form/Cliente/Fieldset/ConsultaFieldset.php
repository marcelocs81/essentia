<?php

namespace Application\Form\Cliente\Fieldset;

use Application\Entity\Cliente;
use Application\Entity\Estabelecimento;
use Application\Entity\Regiao;
use Application\Form\Cliente\InputFilter\ConsultaInputFilter;
use Application\PickList\StatusPickList;
use Application\ValueObject\FiltroCliente;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\Hydrator\ClassMethods;

class ConsultaFieldset extends Fieldset implements InputFilterProviderInterface
{
    /**
     * init method
     */
    public function init()
    {

        $this
            ->setHydrator(new ClassMethods(false))
            ->setObject(new FiltroCliente());

        $this->add(
            [
                'name'       => 'nome',
                'type'       => 'text',
                'options'    => [
                    'label' => 'Nome'
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'class' => 'form-control'
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'email',
                'type'       => 'text',
                'options'    => [
                    'label' => 'E-mail'
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'class' => 'form-control'
                ]
            ]
        );

        $this->add(
            [
                'name'       => 'ativo',
                'type'       => 'Select',
                'options'    => [
                    'label'         => 'Status',
                    'empty_option'  => 'Todos',
                    'value_options' => StatusPickList::getArray()
                ],
                'attributes' => [
                    'style' => 'width: 100%',
                    'class' => 'form-control'
                ]
            ]
        );

        $this->add(
            [
                'type'       => 'Application\Form\Element\ObjectSelect',
                'name'       => 'regiao',
                'options'    => [
                    'value_property'  => 'id',
                    'label'           => 'Região',
                    'label_attributes' => [
                        'class' => ''
                    ],
                    'empty_option'    => 'Todos',
                    'target_class'    => Regiao::class,
                    'label_generator' => function (Regiao $cliente) {
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
                    'id'    => 'select-buscar-regiao',
                    'class' => 'form-control'
                ]
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
        return ['type' => ConsultaInputFilter::class];
    }
}
