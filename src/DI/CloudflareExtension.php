<?php

/*
 * This file is part of the Cloudflare API Nette extension library.
 *
 * (c) Tomas Zaruba <http://github.com/tomaszaruba>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TomasZaruba\Cloudflare\Nette\DI;

use TomasZaruba\Cloudflare\Nette\InvalidArgumentException;


/**
 * Cloudflare API extension for Nette framework
 *
 * @author Tomáš Záruba <info@tomaszaruba.cz>
 * @package TomasZaruba\Cloudflare\Nette\DI
 */
class CloudflareExtension extends \Nette\DI\CompilerExtension
{

    /**
     * @var array config defaults
     */
    public $defaults = [
        'email' => null,
        'key' => null,
        'identifier' => null
    ];



    /**
     * Load configuration and create Cloudflare API service
     */
    public function loadConfiguration()
    {
        $config = $this->getConfig($this->defaults);

        $email = $config['email'];
        $key = $config['key'];

        if (!is_string($email)) {
            throw new InvalidArgumentException('Parameter "email" must be string.');
        }

        if (!is_string($key)) {
            throw new InvalidArgumentException('Parameter "key" must be string.');
        }

        $builder = $this->getContainerBuilder();
        $api = $builder->addDefinition($this->prefix('cloudflare'))
                ->setClass('\TomasZaruba\Cloudflare\Nette\Api', array($email, $key, $config));

        if (isset($config['defaultCache']) && $config['defaultCache'] == true) {
            $builder = $this->getContainerBuilder();
            $builder->addDefinition($this->prefix('cache'))
                    ->setClass('\Cloudflare\Zone\Cache', array($api));
        }
    }
}