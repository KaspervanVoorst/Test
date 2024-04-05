<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall;

class GetListApiCall extends AbstractOTLApiCall
{
    /**
     * @return string
     */
    public function getUri(): string
    {
        return self::BASE_PATH;
    }
}