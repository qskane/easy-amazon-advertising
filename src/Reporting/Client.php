<?php

namespace easyAmazonAdv\Reporting;

use easyAmazonAdv\Kernel\BaseClient;

class Client extends BaseClient
{

    public function createReport(array $params)
    {
        return $this->httpPost('/reporting/reports', $params, [], false);
    }

    public function deleteReport($reportId, $params = [])
    {
        return $this->httpGet("/reporting/reports/{$reportId}", $params, false);
    }

    public function getReport($reportId, $params = [])
    {
        return $this->httpGet("/reporting/reports/{$reportId}", $params, false);
    }

}