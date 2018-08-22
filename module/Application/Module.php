<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
// Classes usadas do sistema
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

// Classe usuario
use Application\Model\Usuario;
use Application\Model\UsuarioTable;
// Classe Campos Dinamicos
use Application\Model\CampoDinamico;
use Application\Model\CampoDinamicoTable;

use Application\View\Helper;
use Zend\ServiceManager\ServiceLocatorInterface;

use Zend\Session\Container;
use Zend\Validator\AbstractValidator;
use Zend\Mvc\I18n\Translator;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {

        $this->bootstrapSession($e);

        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //Esse é o código para a tradução

        //Pega o serviço translator definido no arquivo module.config.php (aliases)
        $translator = $e->getApplication()->getServiceManager()->get('translator');

        //Define o local onde se encontra o arquivo de tradução de mensagens
        $translator->addTranslationFile('phpArray', './vendor/zendframework/zendframework/resources/languages/pt_BR/Zend_Validate.php');

        //Define o local (você também pode definir diretamente no método acima
        $translator->setLocale('pt_BR');
        //Define a tradução padrão do Validator
        AbstractValidator::setDefaultTranslator(new Translator ($translator));

        /** @var \Zend\ModuleManager\ModuleManager $moduleManager */
        $moduleManager = $e->getApplication()->getServiceManager()->get('modulemanager');
        /** @var \Zend\EventManager\SharedEventManager $sharedEvents */
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();

        $entityManager = $e->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $entityManager->getFilters()->enable("soft_delete");

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getViewHelperConfig()
    {

        return array(
            'factories' => array(
                'Params' => function (ServiceLocatorInterface $helpers) {
                    $services = $helpers->getServiceLocator();
                    $app      = $services->get('Application');

                    return new Helper\Params($app->getRequest(), $app->getMvcEvent());
                }
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                /**
                 * Configurações de sessão
                 */
                'Zend\Session\SessionManager'          => 'Application\Service\Factory\SessionManagerServiceFactory',
                'Application\Model\UsuarioTable'       => function ($sm) {
                    //$session = $sm->get('Session');
                    $tableGateway = $sm->get('UsuarioTableGateway');
                    $table        = new UsuarioTable($tableGateway);

                    return $table;
                },
                'UsuarioTableGateway'                  => function ($sm) {
                    $dbAdapter          = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Usuario());

                    return new TableGateway('usuario', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }

    public function getControllerPluginConfig()
    {
        return array(
            'factories' => [

            ]
        );
    }

    public function bootstrapSession($e)
    {

        $session = $e->getApplication()
                     ->getServiceManager()
                     ->get('Zend\Session\SessionManager');
        $session->start();

        $container = new Container('initialized');

        if (!isset($container->init)) {
            $session->regenerateId(true);
            $container->init = 1;
        }
    }

}
