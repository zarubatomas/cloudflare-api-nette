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

use \TomasZaruba\Cloudflare\Nette\Api;


/**
 * Unit tests for SeznamBotDetector
 * @author Tomáš Záruba <info@tomaszaruba.cz>
 * @package TomasZaruba\SeznamBotDetector\Tests
 */
class ApiTest extends \PHPUnit_Framework_TestCase
{



    public function testApi()
    {
        $api = new Api('email', 'key', ['identifier' => '123']);

        $this->assertEquals('123', $api->getParameter('identifier'));

        $this->assertEquals('key', $api->auth_key);
        $this->assertEquals('email', $api->email);
    }
}
