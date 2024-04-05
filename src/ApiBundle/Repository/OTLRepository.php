<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\Repository;

use GuzzleHttp\Exception\GuzzleException;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor\OTLGetByIRIApiCallExecutor;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor\OTLGetListApiCallExecutor;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Factory\OTLApiCallFactory;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject\ConceptList;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Repository\OTLRepositoryInterface;

class OTLRepository implements OTLRepositoryInterface
{
    /**
     * @param OTLApiCallFactory $OTLApiCallFactory
     * @param OTLGetListApiCallExecutor $OTLGetListApiCallExecutor
     * @param OTLGetByIRIApiCallExecutor $OTLGetByIRIApiCallExecutor
     */
    public function __construct(public OTLApiCallFactory $OTLApiCallFactory, public OTLGetListApiCallExecutor $OTLGetListApiCallExecutor, public OTLGetByIRIApiCallExecutor $OTLGetByIRIApiCallExecutor) {}

    /**
     * @return ConceptList
     * @throws GuzzleException
     */
    public function getList(): ConceptList
    {
        $getListApiCall = $this->OTLApiCallFactory->buildGetListApiCall();

        return $this->OTLGetListApiCallExecutor->execute($getListApiCall);
    }

    /**
     * @param string $IRI
     * @return Concept
     * @throws GuzzleException
     */
    public function getByIRI(string $IRI): Concept
    {
        $getByIRIApiCall = $this->OTLApiCallFactory->buildGetByIRIApiCall($IRI);

        $conceptItem = $this->OTLGetByIRIApiCallExecutor->execute($getByIRIApiCall);

        return $conceptItem->getData();
    }
}