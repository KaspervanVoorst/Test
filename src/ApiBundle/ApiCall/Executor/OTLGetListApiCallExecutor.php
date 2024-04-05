<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor;

use GuzzleHttp\Exception\GuzzleException;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\GetListApiCall;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject\ConceptList;

class OTLGetListApiCallExecutor extends AbstractOTLApiCallExecutor
{
    /**
     * @param GetListApiCall $getListApiCall
     * @return ConceptList
     * @throws GuzzleException
     */
    public function execute(GetListApiCall $getListApiCall): ConceptList
    {
        $jsonResponse = $this->executeOTLApiCall($getListApiCall);

        return $this->serializer->deserialize($jsonResponse, ConceptList::class, 'json');
    }
}