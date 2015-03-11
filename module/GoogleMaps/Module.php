<?php
namespace GoogleMaps;

class Module
{
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
    
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'GoogleMaps\Service\GoogleMaps' => function ($sm) {
                    $config = $sm->get('config');
                    return new \GoogleMaps\Service\GoogleMaps($config['GoogleMaps']['api_key']);
                },
            ),
        );
    }
    
}
