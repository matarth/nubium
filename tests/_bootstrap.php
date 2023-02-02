<?php

use Codeception\Util\Fixtures;

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;
$configurator->setDebugMode(false);
$configurator->setTempDirectory(__DIR__ . '/../temp');
$configurator->createRobotLoader()
    ->addDirectory(__DIR__ . '/../app')
    ->addDirectory(__DIR__ . '/../vendor/')
    ->register();

$appDir = dirname(__DIR__);
$configurator->addParameters(['basePath' => $appDir]);

$configurator->addConfig($appDir . '/config/common.neon');
$configurator->addConfig($appDir . '/config/services.neon');
$configurator->addConfig($appDir . "/config/test.neon");


$container = $configurator->createContainer();
Fixtures::add('netteContainer', $container);