<?php
/**
 * Created by Marcelo
 */

namespace Application\Controller\Factory;


use Application\Controller\ClienteController;
use Application\Form\Cliente\ConsultaForm;
use Application\Form\Cliente\ClienteForm;
use Application\Service\ClienteService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClienteControllerFactory implements FactoryInterface
{

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $serviceLocator = $serviceLocator->getServiceLocator();
        $formManager = $serviceLocator->get('FormElementManager');

        $filtroForm = $formManager->get(ConsultaForm::class);
        $clienteForm = $formManager->get(ClienteForm::class);
        $service = $serviceLocator->get(ClienteService::class);

        $controller = new ClienteController($filtroForm, $clienteForm, $service);

        return $controller;
    }
}