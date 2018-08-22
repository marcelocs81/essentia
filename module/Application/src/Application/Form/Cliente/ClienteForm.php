<?php

namespace Application\Form\Cliente;

use Application\Form\Cliente\Fieldset\ConsultaFieldset;
use Application\Form\Cliente\Fieldset\ClienteFieldset;
use Zend\Form\Form;
use Zend\Stdlib\Hydrator\ClassMethods;

class ClienteForm extends Form
{
    public function init()
    {

//        $this->setHydrator(new ClassMethods(false));
//
//        $this->setAttribute('class', 'form-horizontal');
//        $this->setAttribute('id', 'form-pesquisa');
//        $this->setAttribute('method', 'GET');
//
//        $this->add([
//            'type' => ConsultaFieldset::class,
//            'name' => 'search',
//            'options' => array(
//                'use_as_base_fieldset' => true,
//            ),
//        ]);
        $this->setAttribute('id', 'form-cliente');
        $this->setAttribute('method', 'POST');
        $this->setAttribute('class', 'form-horizontal');

        $this->add(array(
            'type' => ClienteFieldset::class,
            'name' => 'cliente',
            'hydrator' => 'DoctrineModule\Stdlib\Hydrator\DoctrineObject',
            'object' => 'Application\Entity\Cliente',
            'options' => array(
                'use_as_base_fieldset' => true
            )
        ));

    }
}