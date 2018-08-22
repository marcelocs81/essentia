<?php


namespace Application\View\Helper\Factory;

use Application\View\Helper\GetDateOrUninformedToCurrentLocale;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class GetDateOrUninformedToCurrentLocaleFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {

        $serviceLocator = $serviceLocator->getServiceLocator();

        $translator = $serviceLocator->get('translator');

        return new GetDateOrUninformedToCurrentLocale($translator);
    }

}
