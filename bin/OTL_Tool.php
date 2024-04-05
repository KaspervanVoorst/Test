<?php

require __DIR__.'/../vendor/autoload.php';

use Kaspervanvoorst\MoxioAssessment\OTLBundle\Commands\GetConceptsCollectionFromAPI;
use Symfony\Component\Console\Application;

$otlTool = new Application();
$otlTool->add(new GetConceptsCollectionFromAPI());

$otlTool->run();