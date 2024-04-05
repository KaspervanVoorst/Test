<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Factory;

use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\GetByIRIApiCall;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\GetListApiCall;

class OTLApiCallFactory
{
    /**
     * @param string $IRI
     * @return GetByIRIApiCall
     */
    public function buildGetByIRIApiCall(string $IRI): GetByIRIApiCall
    {
        return new GetByIRIApiCall($IRI);
    }

    public function buildGetListApiCall(): GetListApiCall
    {
        return new GetListApiCall();
    }
}