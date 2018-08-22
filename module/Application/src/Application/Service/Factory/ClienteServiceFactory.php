<?php

namespace Application\Service\Factory;

use Application\Entity\Cliente;
use Application\Service\ClienteService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Created by Marcelo
 */
class ClienteServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $objectManager = $serviceLocator->get('Doctrine\ORM\EntityManager');
        $repository     = $objectManager->getRepository(Cliente::class);

        return new ClienteService($objectManager, $repository);
    }

}