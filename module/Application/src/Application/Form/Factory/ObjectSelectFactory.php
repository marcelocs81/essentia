<?php

namespace Application\Form\Factory;

use Application\Form\Element\ObjectSelect;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ObjectSelectFactory implements FactoryInterface
{
    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services = $serviceLocator->getServiceLocator();
        $entityManager = $services->get('Doctrine\ORM\EntityManager');
        $element = new ObjectSelect();

        $element->getProxy()->setObjectManager($entityManager);

        return $element;
    }

}
