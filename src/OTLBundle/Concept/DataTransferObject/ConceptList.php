<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject;

use JMS\Serializer\Annotation as Serializer;

class ConceptList
{
    #[Serializer\Type("array<Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept>")]
    private array $data;

    public function getData(): array
    {
        return $this->data;
    }
}