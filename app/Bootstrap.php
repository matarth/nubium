<?php

declare(strict_types=1);

namespace App;

use Nette\Bootstrap\Configurator;

class Bootstrap
{
    public static function boot(string $environment): Configurator
    {
        $configurator = new Configurator;
        $appDir = dirname(__DIR__);

        $configurator->setDebugMode(true);
        $configurator->enableTracy($appDir . '/log');

        $configurator->setTimeZone('Europe/Prague');
        $configurator->setTempDirectory($appDir . '/temp');

        $configurator->createRobotLoader()
            ->addDirectory(__DIR__)
            ->register();

        $configurator->addParameters(['basePath' => $appDir]);
        $configurator->addConfig($appDir . '/config/common.neon');
        $configurator->addConfig($appDir . '/config/services.neon');
        $configurator->addConfig($appDir . "/config/$environment.neon");

        return $configurator;
    }
}
