<?php

declare(strict_types=1);

use Nette\Bootstrap\Configurator;

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Configurator;
$appDir = dirname(__DIR__);

$configurator->setDebugMode(false);
$configurator->enableTracy($appDir . '/log');

$configurator->setTimeZone('Europe/Prague');
$configurator->setTempDirectory($appDir . '/temp');

$configurator->addStaticParameters(['basePath' => $appDir]);
$configurator->addConfig($appDir . '/config/common.neon');
$configurator->addConfig($appDir . '/config/services.neon');
$configurator->addConfig($appDir . "/config/test.neon");

$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->register();

$container = $configurator->createContainer();
$application = $container->getByType(Nette\Application\Application::class);
$application->run();
