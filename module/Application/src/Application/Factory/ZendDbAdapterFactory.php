<?php
/**
 * Created by Marcelo
 */

namespace Application\Factory;


use Zend\Db\Adapter\AdapterServiceFactory;
use Zend\Db\TableGateway\Feature\GlobalAdapterFeature;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ZendDbAdapterFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapterFactory = new AdapterServiceFactory();
        $adapter        = $adapterFactory->createService($serviceLocator);
        GlobalAdapterFeature::setStaticAdapter($adapter);
        return  $adapter;
    }
}