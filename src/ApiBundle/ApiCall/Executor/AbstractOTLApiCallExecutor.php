<?php

namespace Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializerInterface;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\AbstractOTLApiCall;

class AbstractOTLApiCallExecutor
{
    public SerializerInterface $serializer;

    public function __construct(public SerializerBuilder $serializerBuilder, public ClientInterface $client)
    {
        $this->serializer = $this->serializerBuilder->build();
    }

    /**
     * @param AbstractOTLApiCall $OTLApiCall
     * @return string
     * @throws GuzzleException
     */
    protected function executeOTLApiCall(AbstractOTLApiCall $OTLApiCall): string
    {
        $uri = $OTLApiCall->getUri();
        $apiKey = $OTLApiCall->getApiKey();
        $method = $OTLApiCall->getMethod();

        $request = new Request($method, $uri);
        $request = $request->withAddedHeader('Authorization', 'ApiKey ' . $apiKey);

        $response = $this->client->send($request);

        return $response->getBody()->getContents();
    }
}