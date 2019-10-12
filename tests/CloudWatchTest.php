<?php


namespace MonologCloudWatch\Test;


use Maxbanton\Cwh\Handler\CloudWatch;
use MonologCloudWatch\Aws\CloudWatchClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CloudWatchTest extends KernelTestCase
{
    /**
     * @var CloudWatch
     */
    protected static $handler;

    /**
     * @var CloudWatchClient
     */
    protected static $client;

    public static function setUpBeforeClass()
    {
        //start the symfony kernel
        $kernel = static::createKernel();
        $kernel->boot();

        //get the DI container
        self::$container = $kernel->getContainer();

        //now we can instantiate our service (if you want a fresh one for
        //each test method, do this in setUp() instead
        self::$client = self::$container->get('monolog_cloud_watch.client');
        self::$handler = self::$container->get('monolog_cloud_watch.handler');
    }

    public function testServicesAvailableInContainer()
    {
        $this->assertInstanceOf(CloudWatchClient::class, self::$client);
        $this->assertInstanceOf(CloudWatch::class, self::$handler);
    }

}