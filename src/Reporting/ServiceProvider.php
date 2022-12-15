<?php

namespace easyAmazonAdv\Reporting;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['reporting'] = function ($app) {
            return new Client($app);
        };
    }
}
