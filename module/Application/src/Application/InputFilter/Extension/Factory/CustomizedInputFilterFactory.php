<?php

namespace Application\InputFilter\Extension\Factory;

use Application\InputFilter\Extension\CollectionInputFilter;
use Zend\InputFilter\Exception;
use Zend\InputFilter\Factory;

class CustomizedInputFilterFactory extends Factory
{
    /**
     * @override
     * @param array|\Traversable $inputFilterSpecification
     * @return \Zend\InputFilter\InputFilterInterface
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function createInputFilter($inputFilterSpecification)
    {
        $inputFilter = parent::createInputFilter($inputFilterSpecification);
        if ($inputFilter instanceof CollectionInputFilter) {

            if (isset($inputFilterSpecification['unique_fields'])) {
                $inputFilter->setUniqueFields($inputFilterSpecification['unique_fields']);
            }

            if (isset($inputFilterSpecification['exclude'])) {
                $inputFilter->setExclude($inputFilterSpecification['exclude']);
            }

            if (isset($inputFilterSpecification['max'])) {
                $inputFilter->setMax($inputFilterSpecification['max']);
            }

            if (isset($inputFilterSpecification['min'])) {
                $inputFilter->setMin($inputFilterSpecification['min']);
            }

            if (isset($inputFilterSpecification['child_required'])) {
                $inputFilter->setChildRequired($inputFilterSpecification['child_required']);
            }
        }
        return $inputFilter;
    }
} 