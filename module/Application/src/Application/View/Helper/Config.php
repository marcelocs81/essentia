<?php
namespace Application\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Helper que inclui a sess�o nas views
 *
 * @category Application
 * @package View\Helper
 * @author Marcelo C. de Souza <marcelocs81@gmail.com>
 *        
 */
class Config extends AbstractHelper implements ServiceLocatorAwareInterface
{

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return CustomHelper
     *
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

    /**
     * Get the service locator.
     *
     * @return \Zend\ServiceManager\ServiceLocatorInterface
     *
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function __invoke($param = null)
    {
        $helperPluginManager = $this->getServiceLocator();
        $serviceManager = $helperPluginManager->getServiceLocator();
        $config = $serviceManager->get('config');
        if ($config[$param]) {
            return $config[$param];
        } else {
            return "Não Encontrado";
        }    
    }
} 