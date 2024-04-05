<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\GetListApiCall;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\DataTransferObject\ConceptList;

class OTLGetListApiCallExecutor
{
    public SerializerInterface $serializer;

    public function __construct(public SerializerBuilder $serializerBuilder, public ClientInterface $client)
    {
        $this->serializer = $this->serializerBuilder->build();
    }

    /**
     * @param GetListApiCall $getListApiCall
     * @return ConceptList
     * @throws GuzzleException
     */
    public function execute(GetListApiCall $getListApiCall): ConceptList
    {
        $uri = $getListApiCall->getUri();
        $apiKey = $getListApiCall->getApiKey();
        $method = $getListApiCall->getMethod();

        $request = new Request($method, $uri);
        $request = $request->withAddedHeader('Authorization', 'ApiKey ' . $apiKey);

        $response = $this->client->send($request);

        $jsonResponse = $response->getBody()->getContents();

        return $this->serializer->deserialize($jsonResponse, ConceptList::class, 'json');
    }
}