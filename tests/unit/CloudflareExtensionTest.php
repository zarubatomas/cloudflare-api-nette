<?php

/*
 * This file is part of the SeznamBotDetect library.
 *
 * (c) Tomas Zaruba <http://github.com/tomaszaruba>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TomasZaruba\Cloudflare\Nette\Tests;

use \TomasZaruba\Cloudflare\Nette\DI\CloudflareExtension;


/**
 * Unit tests for SeznamBotDetector
 * @author Tomáš Záruba <info@tomaszaruba.cz>
 * @package TomasZaruba\SeznamBotDetector\Tests
 */
class CloudflareExtensionTest extends \Codeception\Test\Unit
{

    public function testExtensionMinimalConfiguration()
    {
        $container = $this->createContainer(__DIR__ . '/config/basic.neon');

        $cloudflareApi = $container->getService('cloudflare.cloudflare');

        $this->assertEquals('email@email.com', $cloudflareApi->email);
        $this->assertEquals('abc', $cloudflareApi->auth_key);
    }



    public function testExtensionCache()
    {
        $container = $this->createContainer(__DIR__ . '/config/cache.neon');

        $cloudflareCache = $container->getService('cloudflare.cache');

        $this->assertInstanceOf('\Cloudflare\Zone\Cache', $cloudflareCache);
    }



    public function testExtensionOtherParameters()
    {
        $container = $this->createContainer(__DIR__ . '/config/other-parameters.neon');

        $cloudflareApi = $container->getService('cloudflare.cloudflare');

        $this->assertInstanceOf('\TomasZaruba\Cloudflare\Nette\Api', $cloudflareApi);

        $this->assertEquals('exampleIdentifier', $cloudflareApi->getParameter('identifier'));
    }



    public function testExtensionMissingEmail()
    {
        $this->setExpectedException('TomasZaruba\Cloudflare\Nette\InvalidArgumentException', 'Parameter "email" must be string.');

        $container = $this->createContainer(__DIR__ . '/config/missing-email.neon');

        $container->getService('cloudflare.cloudflare');
    }



    public function testExtensionMissingKey()
    {
        $this->setExpectedException('TomasZaruba\Cloudflare\Nette\InvalidArgumentException', 'Parameter "key" must be string.');

        $container = $this->createContainer(__DIR__ . '/config/missing-key.neon');

        $container->getService('cloudflare.cloudflare');
    }



    private function createContainer($config)
    {
        $configurator = new \Nette\Configurator();

        $configurator->enableDebugger(__DIR__ . '/log');
        $configurator->setTempDirectory(__DIR__ . '/temp');

        $configurator->addConfig($config);

        return $configurator->createContainer();
    }
}
