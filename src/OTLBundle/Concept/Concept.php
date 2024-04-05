<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept;

use JMS\Serializer\Annotation as Serializer;

class Concept
{
    /**
     * @var string
     */
    #[Serializer\Type("string")]
    #[Serializer\SerializedName("IRI")]
    private string $IRI;

    /**
     * @var string
     */
    #[Serializer\Type("string")]
    #[Serializer\SerializedName("naam")]
    private string $name;

    /**
     * @var array<Concept>
     */
    #[Serializer\Type("array<Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Concept>")]
    #[Serializer\SerializedName("subtypen")]
    private array $subtypes;

    public function getIRI(): string
    {
        return $this->IRI;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getSubtypes(): array
    {
        return $this->subtypes;
    }
}