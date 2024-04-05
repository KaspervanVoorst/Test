<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall;

abstract class AbstractOTLApiCall
{
    public const BASE_PATH = 'https://otl.prorail.nl/otl/api/rest/v1/vigerende-versie/concepten/';

    private const DEFAULT_METHOD = 'GET';

    private const API_KEY = '<secret>';

    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return self::API_KEY;
    }

    public function getMethod(): string
    {
        return self::DEFAULT_METHOD;
    }

    public abstract function getUri(): string;
}