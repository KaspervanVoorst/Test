<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall;

class GetByIRIApiCall extends AbstractOTLApiCall
{
    /**
     * @var string
     */
    private string $IRI;

    /**
     * @param string $IRI
     */
    public function __construct(string $IRI)
    {
        $this->IRI = $IRI;
    }

    public function getUri(): string
    {
        $encodedIRI = \urlencode($this->IRI);

        return self::BASE_PATH . $encodedIRI;
    }
}