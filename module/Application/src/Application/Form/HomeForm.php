<?php
namespace Application\Form;

use Zend\Form\Form;

class HomeForm extends Form
{

    
    public function __construct($name = null, $options = array())
    {

        parent::__construct('homeForm');
        
        $this->add(array(
            'name' => 'VALID',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'VALID',
            )));
        $this->add(array(
            'name' => 'cadastroId',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'cadastroId',
            )));
        $this->add(array(
            'name' => 'processoId',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'processoId',
            )));
         $this->add(array(
            'name' => 'area',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'area',
            )));   
         
        $this->add(array(
            'name' => 'processoCad',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'processoCad',
                'class' => 'form-control col-xs-12',
                'onchange' => 'selecionaProcesso();',
            ),
            'options' => array(
                'label' => 'Numero do Processo'
            )
        ));
        $this->add(array(
            'name' => 'tipoCad',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'tipoCad',
            )));
        $this->add(array(
            'name' => 'tipoAcao',
            'attributes' => array(
                'type' => 'hidden',
                'id' => 'tipoAcao',
            )));
        $this->add(array(
            'name' => 'nomeCad',            
            'attributes' => array(   
                'id' => 'nomeCad',
                'type' => 'text',
                'class' => 'form-control col-xs-12',
                'required' => 'required',
                'placeholder' => 'Digite o Nome do Cliente'
            ),
            'options' => array(
                'label' => 'Nome do Cliente'
            )
        ));
        $this->add(array(
            'name' => 'cpfCad',
            'attributes' => array(
                'id' => 'cpfCad',
                'type' => 'text',
                'class' => 'form-control col-xs-12',
                'placeholder' => 'Digite o CPF ou CNPJ'
            ),
            'options' => array(
                'label' => 'CPF / CNPJ'
            )
        ));
        $this->add(array(
            'name' => 'statusCad',
            'attributes' => array(
                'id' => 'statusCad',
                'type' => 'text',
                'class' => 'form-control col-xs-12',
                'placeholder' => ''
            ),
            'options' => array(
                'label' => 'Status do Processo'
            )
        ));
        
        $this->add(array(
            'name' => 'telefoneCad',
            'type' => 'Zend\Form\Element\Select',
            'attributes' => array(
                'id' => 'telefoneCad',
                'class' => 'form-control col-xs-12',
            ),
            'options' => array(
                'label' => 'Telefone'
            )
        ));
    
    }
}