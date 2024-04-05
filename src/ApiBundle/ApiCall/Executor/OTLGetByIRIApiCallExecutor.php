<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\GetByIRIApiCall;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject\ConceptItem;

class OTLGetByIRIApiCallExecutor
{
    public SerializerInterface $serializer;

    public function __construct(public SerializerBuilder $serializerBuilder, public ClientInterface $client)
    {
        $this->serializer = $this->serializerBuilder->build();
    }

    /**
     * @param GetByIRIApiCall $getByIRIApiCall
     * @return ConceptItem
     * @throws GuzzleException
     */
    public function execute(GetByIRIApiCall $getByIRIApiCall): ConceptItem
    {
        $uri = $getByIRIApiCall->getUri();
        $apiKey = $getByIRIApiCall->getApiKey();
        $method = $getByIRIApiCall->getMethod();

        $request = new Request($method, $uri);
        $request = $request->withAddedHeader('Authorization', 'ApiKey ' . $apiKey);

        $response = $this->client->send($request);

        $jsonResponse = $response->getBody()->getContents();

        return $this->serializer->deserialize($jsonResponse, ConceptItem::class, 'json');
    }
}