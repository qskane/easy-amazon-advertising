<?php

namespace easyAmazonAdv\SponsoredBrands;

use easyAmazonAdv\Kernel\Provider\ClientServiceProvider;
use easyAmazonAdv\Kernel\Provider\LoggerServiceProvider;
use easyAmazonAdv\Kernel\Support\Collection;
use Pimple\Container;

/**
 * Class Application.
 *
 * @property \easyAmazonAdv\SponsoredBrands\Bid\Client $bid
 * @property \easyAmazonAdv\SponsoredBrands\Campaigns\Client $campaigns
 * @property \easyAmazonAdv\SponsoredBrands\Groups\Client $groups
 * @property \easyAmazonAdv\SponsoredBrands\Keywords\Client $keywords
 * @property \easyAmazonAdv\SponsoredBrands\ProductTargeting\Client $product_targeting
 * @property \easyAmazonAdv\SponsoredBrands\Report\Client $report
 *
 * @author  baihe <b_aihe@163.com>
 * @date    2019-11-13 23:51
 */
class Application extends Container
{
    /**
     * @var array
     */
    protected $providers = [
        ClientServiceProvider::class,
        LoggerServiceProvider::class,
        Report\ServiceProvider::class,
        Campaigns\ServiceProvider::class,
        Groups\ServiceProvider::class,
        Keywords\ServiceProvider::class,
    ];

    /**
     * Application constructor.
     *
     * @param array $config
     * @param array $values
     */
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

    /**
     * __get.
     *
     * @param $name
     *
     * @return mixed
     *
     * @author  baihe <b_aihe@163.com>
     * @date    2019-11-13 23:52
     */
    public function __get($name)
    {
        return $this[$name];
    }
}
