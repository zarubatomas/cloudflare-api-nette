<?php

/*
 * This file is part of the Cloudflare API Nette extension library.
 *
 * (c) Tomas Zaruba <http://github.com/tomaszaruba>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace TomasZaruba\Cloudflare\Nette;


/**
 * Cloudflare API client
 *
 * @author Tomáš Záruba <info@tomaszaruba.cz>
 * @package TomasZaruba\Cloudflare\Nette
 */
class Api extends \Cloudflare\Api
{

    /**
     * @var array other parameters used in API
     */
    private $params = array();



    /**
     * @param $email string API email
     * @param $key string API key
     * @param null $params other parameters
     */
    public function __construct($email, $key, $params = null)
    {
        parent::__construct($email, $key);

        if (is_array($params)) {
            $this->params = $params;
        }
    }



    /**
     * Return other parameters from configuration
     *
     * @param $name string parameter name
     * @return null|mixed parameter value
     */
    public function getParameter($name)
    {
        if (array_key_exists($name, $this->params)) {

            return $this->params[$name];
        } else {

            return null;
        }
    }
}