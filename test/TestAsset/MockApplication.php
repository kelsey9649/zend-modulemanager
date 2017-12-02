<?php
/**
 * @link      http://github.com/zendframework/zend-modulemanager for the canonical source repository
 * @copyright Copyright (c) 2005-2017 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   https://github.com/zendframework/zend-modulemanager/blob/master/LICENSE.md New BSD License
 */
declare(strict_types=1);

namespace ZendTest\ModuleManager\TestAsset;

use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\Mvc\MvcEvent;

class MockApplication implements ApplicationInterface
{
    public $events;
    public $request;
    public $response;
    public $serviceManager;

    public function setEventManager(EventManagerInterface $events)
    {
        $this->events = $events;
    }

    /**
     * {@inheritDoc}
     */
    public function getEventManager()
    {
        return $this->events;
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }

    public function setServiceManager($serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * {@inheritDoc}
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        return $this->response;
    }

    public function bootstrap()
    {
        $event = new MvcEvent();
        $event->setApplication($this);
        $event->setTarget($this);
        $event->setName(MvcEvent::EVENT_BOOTSTRAP);
        $this->getEventManager()->triggerEvent($event);
    }
}
