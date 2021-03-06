<?php

namespace Application\InputFilter\Extension;

use Application\InputFilter\Extension\Factory\CustomizedInputFilterFactory;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Traversable;

/**
 * Class CustomizedInputFilter
 * @package Admin\InputFilter
 */
class CustomizedInputFilter extends InputFilter
{

    /**
     * Set factory to use when adding inputs and filters by spec
     *
     * @param  CustomizedInputFilterFactory $factory
     * @return InputFilter
     */
    public function setFactory(CustomizedInputFilterFactory $factory)
    {
        $this->factory = $factory;
        return $this;
    }

    /**
     * Get factory to use when adding inputs and filters by spec
     *
     * Lazy-loads a Factory instance if none attached.
     *
     * @return CustomizedInputFilterFactory
     */
    public function getFactory()
    {
        if (null === $this->factory) {
            $this->setFactory(new CustomizedInputFilterFactory());
        }
        return $this->factory;
    }

    /**
     * Sobreescrita do método add do input filter
     * Devida a dificuldade de setar as opçoes no CollectionInputFilter
     *
     * @override
     * @method add($input, $name = null);
     * @param array|Traversable|InputFilterInterface|\Zend\InputFilter\InputInterface $input
     * @param null $name
     * @return InputFilter
     * @author Marcelo C. de Souza <marcelocs81@gmail.com>
     */
    public function add($input, $name = null)
    {
        if (is_array($input)
            || ($input instanceof Traversable && !$input instanceof InputFilterInterface)
        ) {
            $factory = $this->getFactory();
            $input = $factory->createInput($input);
        }
        return parent::add($input, $name); // TODO: Change the autogenerated stub
    }
} 