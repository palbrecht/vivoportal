<?php
namespace Vivo\Service\Controller;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;

/**
 * Factory for CMSFrontController
 */
class CMSFrontControllerFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $fc = new \Vivo\Controller\CMSFrontController();
        $sm = $serviceLocator->getServiceLocator();
        $siteEvent = $sm->get('site_event');
        if ($siteEvent->getSite()) {
            $fc->setComponentFactory($sm->get('component_factory'));
        }
        $fc->setComponentTreeController($sm->get('Vivo\UI\ComponentTreeController'));
        $fc->setCMS($sm->get('Vivo\CMS\Api\CMS'));
        $fc->setSiteEvent($siteEvent);
        return $fc;
    }
}
