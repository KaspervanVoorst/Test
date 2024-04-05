<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor;

use GuzzleHttp\Exception\GuzzleException;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\GetByIRIApiCall;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject\ConceptItem;

class OTLGetByIRIApiCallExecutor extends AbstractOTLApiCallExecutor
{
    /**
     * @param GetByIRIApiCall $getByIRIApiCall
     * @return ConceptItem
     * @throws GuzzleException
     */
    public function execute(GetByIRIApiCall $getByIRIApiCall): ConceptItem
    {
        $jsonResponse = $this->executeOTLApiCall($getByIRIApiCall);

        return $this->serializer->deserialize($jsonResponse, ConceptItem::class, 'json');
    }
}