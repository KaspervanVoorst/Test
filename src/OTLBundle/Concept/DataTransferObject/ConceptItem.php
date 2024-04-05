<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject;

use JMS\Serializer\Annotation as Serializer;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept;

class ConceptItem
{
    /**
     * @var Concept
     */
    #[Serializer\Type("Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept")]
    private Concept $data;

    /**
     * @return Concept
     */
    public function getData(): Concept
    {
        return $this->data;
    }
}