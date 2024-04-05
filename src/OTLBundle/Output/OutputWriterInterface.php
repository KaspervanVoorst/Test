<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Output;

use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Collection\ConceptCollection;

interface OutputWriterInterface
{
    /**
     * @param ConceptCollection $conceptCollection
     */
    public function writeOutput(ConceptCollection $conceptCollection): void;
}