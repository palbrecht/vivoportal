<?php
namespace Vivo\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\FactoryInterface;

/**
 * RepositoryFactory
 */
class RepositoryFactory implements FactoryInterface
{
    /**
     * Create service
     * @param ServiceLocatorInterface $serviceLocator
     * @throws Exception\ConfigException
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('config');
        if (!isset($config['repository']['storage'])) {
            throw new Exception\ConfigException(sprintf("%s: Repository storage configuration missing", __METHOD__));
        }
        $storageConfig  = $config['repository']['storage'];
        $storageConfig['options']['path_builder']   = $serviceLocator->get('path_builder');
        $storageFactory         = $serviceLocator->get('storage_factory');
        /* @var $storageFactory \Vivo\Storage\Factory */
        $storage                = $storageFactory->create($storageConfig);
        $serializer             = new \Vivo\Serializer\Adapter\Entity();
        $watcher                = new \Vivo\Repository\Watcher();
        $ioUtil                 = $serviceLocator->get('io_util');
        $events                 = $serviceLocator->get('repository_events');
        //TODO - supply a real cache
        $repository             = new \Vivo\Repository\Repository($storage,
                                                                  null,
                                                                  $serializer,
                                                                  $watcher,
                                                                  $ioUtil,
                                                                  $events);
        return $repository;
    }
}
