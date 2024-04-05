<?php

namespace Kaspervanvoorst\MoxioAssessment\OutputBundle;

use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Collection\ConceptCollection;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Output\OutputWriterInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleOutputWriter implements OutputWriterInterface
{
    public function __construct(public OutputInterface $output) {}

    /**
     * @param ConceptCollection $conceptCollection
     * @return void
     */
    public function writeOutput(ConceptCollection $conceptCollection): void
    {
        /** @var Concept $concept */
        foreach ($conceptCollection as $concept) {
            $transitiveSubtypesCount = $conceptCollection->getTransitiveSubtypeCountByIRI($concept->getIRI());

            $this->output->writeln(\sprintf('IRI: %s, Naam: %s, Transitieve subtypes: %s', $concept->getIRI(), $concept->getName(), $transitiveSubtypesCount));
        }
    }
}