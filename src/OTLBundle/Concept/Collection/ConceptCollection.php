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

    /**
     * @param string $IRI
     * @return int
     */
    public function getTransitiveSubtypeCountByIRI(string $IRI): int
    {
        return count($this->getTransitiveSubtypesByIRI($IRI));
    }

    /**
     * @param string $IRI
     * @return array
     */
    public function getTransitiveSubtypesByIRI(string $IRI): array
    {
        $concept = $this->getByIRI($IRI);
        $subtypes = $concept->getSubtypes();

        $transitiveSubtypes = [];
        foreach ($subtypes as $subtype) {
            $subtypeTransitiveSubtypes = $this->getTransitiveSubtypesByIRI($subtype->getIRI());
            $transitiveSubtypes = array_merge($transitiveSubtypes, $subtypeTransitiveSubtypes);
        }

        return array_unique(array_merge($transitiveSubtypes, $subtypes), SORT_REGULAR);
    }

    /**
     * @return Traversable
     */
    public function getIterator(): Traversable
    {
        return new \ArrayIterator($this->concepts);
    }
}