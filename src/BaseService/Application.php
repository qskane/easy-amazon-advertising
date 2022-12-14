<?php

namespace easyAmazonAdv\BaseService;

use easyAmazonAdv\Kernel\Provider\ClientServiceProvider;
use easyAmazonAdv\Kernel\Provider\LoggerServiceProvider;
use easyAmazonAdv\Kernel\Support\Collection;
use Pimple\Container;

/**
 *
 * @property \easyAmazonAdv\BaseService\Profiles\Client $profiles
 * @property \easyAmazonAdv\BaseService\Portfolios\Client $portfolios
 * @property \easyAmazonAdv\BaseService\OAuth\Client $oauth
 * @property \easyAmazonAdv\BaseService\AccessToken\Client $access_token
 */
class Application extends Container
{
    protected $providers = [
        ClientServiceProvider::class,
        LoggerServiceProvider::class,
        AccessToken\ServiceProvider::class,
        Profiles\ServiceProvider::class,
        Portfolios\ServiceProvider::class,
        OAuth\ServiceProvider::class,
    ];

    public function __construct($config = [], array $values = [])
    {
        parent::__construct($values);
        $this['config'] = function () use ($config) {
            return new Collection($config);
        };
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    public function __get($name)
    {
        return $this[$name];
    }
}
