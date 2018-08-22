<?php

namespace Application\Form\Cliente;

use Application\Form\Cliente\Fieldset\ConsultaFieldset;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class ConsultaForm extends Form
{
    public function init()
    {

        $this->setHydrator(new ClassMethods(false));

        $this->setAttribute('class', 'form-horizontal');
        $this->setAttribute('id', 'form-pesquisa');
        $this->setAttribute('method', 'GET');

        $this->add([
            'type' => ConsultaFieldset::class,
            'name' => 'filtro',
            'options' => array(
                'use_as_base_fieldset' => true,
            ),
        ]);
    }
}