<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Repository;

use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject\ConceptList;

interface OTLRepositoryInterface
{
    /**
     * @return ConceptList
     */
    public function getList(): ConceptList;

    /**
     * @param string $IRI
     * @return Concept
     */
    public function getByIRI(string $IRI): Concept;
}