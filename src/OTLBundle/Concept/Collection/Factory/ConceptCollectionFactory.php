<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Collection\Factory;

use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Collection\ConceptCollection;

class ConceptCollectionFactory
{
    /**
     * @param array $concepts
     * @return ConceptCollection
     */
    public function buildCollection(array $concepts): ConceptCollection
    {
        $conceptCollection = new ConceptCollection();

        foreach ($concepts as $concept) {
            $conceptCollection->add($concept);
        }

        return $conceptCollection;
    }
}