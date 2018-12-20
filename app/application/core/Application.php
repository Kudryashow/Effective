<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.12.18
 * Time: 10:55
 */

namespace application\core;

class Application
{
    public $services = [];
    public $router;
    public function __construct($params)
    {
        if ($params['services']) {
            $this->configurateServices($params['services']);
        }
    }

    public function run()
    {
        $this->router = new Router($this->getConfig('ConfigService', 'routes'));
        $this->router->run();
    }
    public function getConfig($serviceName, $config)
    {
        return $this->services[$serviceName]->getConfig($config);
    }

    private function configurateServices($config)
    {
       foreach ($config as $serviceName=>$serviceSettings) {
           $this->services[$serviceName] =
               new $serviceSettings['class']($serviceSettings['path']);
       }
    }
}