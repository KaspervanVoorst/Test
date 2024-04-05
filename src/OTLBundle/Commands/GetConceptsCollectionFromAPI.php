<?php

namespace Kaspervanvoorst\MoxioAssessment\OTLBundle\Commands;

use GuzzleHttp\Client;
use JMS\Serializer\SerializerBuilder;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor\OTLGetByIRIApiCallExecutor;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Executor\OTLGetListApiCallExecutor;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\ApiCall\Factory\OTLApiCallFactory;
use Kaspervanvoorst\MoxioAssessment\ApiBundle\Repository\OTLRepository;
use Kaspervanvoorst\MoxioAssessment\OTLBundle\Concept\Collection\Factory\ConceptCollectionFactory;
use Kaspervanvoorst\MoxioAssessment\OutputBundle\ConsoleOutputWriter;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetConceptsCollectionFromAPI extends Command
{

    /**
     * @var string
     */
    private CONST NAME = 'concepts:api:collection';

    /**
     * @var string
     */
    private CONST DESCRIPTION = 'Fetch all Concepts from the OTL Rest API';

    protected function configure(): void
    {
        $this->setName(self::NAME);
        $this->setDescription(self::DESCRIPTION);
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception|\GuzzleHttp\Exception\GuzzleException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $apiCallFactory = new OTLApiCallFactory();

        $serializerBuilder = new SerializerBuilder();
        $guzzleClient = new Client();
        $OTLGetListApiCallExecutor = new OTLGetListApiCallExecutor($serializerBuilder, $guzzleClient);
        $OTLGetByIRIApiCallExecutor = new OTLGetByIRIApiCallExecutor($serializerBuilder, $guzzleClient);

        $apiRepository = new OTLRepository($apiCallFactory, $OTLGetListApiCallExecutor, $OTLGetByIRIApiCallExecutor);

        $list = $apiRepository->getList();
        $listData = $list->getData();

        $conceptCollectionFactory = new ConceptCollectionFactory();

        $concepts = [];
        foreach ($listData as $conceptListItem) {
            $output->writeln('Item: ' . $conceptListItem->getName());
            $concepts[] = $apiRepository->getByIRI($conceptListItem->getIRI());
        }

        $conceptCollection = $conceptCollectionFactory->buildCollection($concepts);

        $outputWriter = new ConsoleOutputWriter($output);
        $outputWriter->writeOutput($conceptCollection);

        return 1;
    }
}