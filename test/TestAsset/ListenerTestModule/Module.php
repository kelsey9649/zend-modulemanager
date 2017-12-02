<?php
/**
 * @link      http://github.com/zendframework/zend-modulemanager for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-modulemanager/blob/master/LICENSE.md New BSD License
 */
declare(strict_types=1);

namespace ListenerTestModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\ModuleManager\Feature\LocatorRegisteredInterface;
use Zend\EventManager\EventInterface;

class Module implements
    AutoloaderProviderInterface,
    BootstrapListenerInterface,
    LocatorRegisteredInterface
{
    public $initCalled = false;
    public $getConfigCalled = false;
    public $getAutoloaderConfigCalled = false;
    public $onBootstrapCalled = false;

    public function init($moduleManager = null)
    {
        $this->initCalled = true;
    }

    public function getConfig()
    {
        $this->getConfigCalled = true;
        return [
            'listener' => 'test'
        ];
    }

    public function getAutoloaderConfig()
    {
        $this->getAutoloaderConfigCalled = true;
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [
                    'Foo' => __DIR__ . '/src/Foo',
                ],
            ],
        ];
    }

    public function onBootstrap(EventInterface $e)
    {
        $this->onBootstrapCalled = true;
    }
}
