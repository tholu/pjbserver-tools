<?php

namespace PjbServerTest\Tools;

use PjbServerTestConfig;
use PjbServer\Tools\StandaloneServer;

class StandaloneServerConstructTest extends \PHPUnit_Framework_TestCase
{

    protected function setUp()
    {
    }

    protected function tearDown()
    {
    }

    public function testConstructorThrowsInvalidArgumentException()
    {
        $this->expectException(\PjbServer\Tools\Exception\InvalidArgumentException::class);
        $config = [];
        $server = new StandaloneServer($config);
    }

    public function testConstructorThrowsInvalidArgumentException2()
    {
        $this->expectException(\PjbServer\Tools\Exception\InvalidArgumentException::class);
        $config = ['port' => 'cool'];
        $server = new StandaloneServer($config);
    }

    public function testConstructorThrowsInvalidArgumentException3()
    {
        $this->expectException(\PjbServer\Tools\Exception\InvalidArgumentException::class);
        $config = [
            'port' => '8192',
            'server_jar' => '/invalid_path/JavaBridge.jar'
        ];
        $server = new StandaloneServer($config);
    }

    public function testConstructorThrowsInvalidArgumentException4()
    {
        $this->expectException(\PjbServer\Tools\Exception\InvalidArgumentException::class);
        $config = [
            'error_file' => '/invalid_path/pjb621_standalone/logs/error.log',
        ];
        $server = new StandaloneServer($config);
    }

    public function testConstructorThrowsInvalidArgumentException5()
    {
        $this->expectException(\PjbServer\Tools\Exception\InvalidArgumentException::class);
        $config = [
            'pid_file' => '/invalid_path/resources/pjb621_standalone/var/run/server.pid'
        ];
        $server = new StandaloneServer($config);
    }


    public function testGetServerPort()
    {
        $config = PjbServerTestConfig::getStandaloneServerConfig();
        $server = new StandaloneServer($config);
        $port = $server->getServerPort();
        $this->assertEquals($config['port'], $port);
    }

    public function testGetServerConfig()
    {
        $config = PjbServerTestConfig::getStandaloneServerConfig();
        $server = new StandaloneServer($config);
        $config = $server->getConfig();
        $this->assertInternalType('array', $config);
        $this->assertArrayHasKey('port', $config);
        $this->assertArrayHasKey('java_bin', $config);
        $this->assertArrayHasKey('log_file', $config);
        $this->assertArrayHasKey('pid_file', $config);
    }
}