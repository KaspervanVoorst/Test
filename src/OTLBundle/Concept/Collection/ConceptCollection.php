<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Collection;

use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept;
use Traversable;

class ConceptCollection implements \IteratorAggregate
{
    /**
     * @var array<Concept>
     */
    private array $concepts;

    /**
     * @param Concept $concept
     * @return void
     */
    public function add(Concept $concept): void
    {
        $IRI = $concept->getIRI();
        $this->concepts[$IRI] = $concept;
    }

    /**
     * @param string $IRI
     * @return ?Concept
     */
    public function getByIRI(string $IRI): ?Concept
    {
        return $this->concepts[$IRI];
    }

    public function getTransitiveSubtypeCountByIRI(string $IRI): int
    {
        $concept = $this->getByIRI($IRI);
        $subtypes = $concept->getSubtypes();

        $subtypeCount = \count($subtypes);

        foreach ($subtypes as $subtype) {
            $subtypeCount += $this->getTransitiveSubtypeCountByIRI($subtype->getIRI());
        }

        return $subtypeCount;
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->concepts);
    }
}