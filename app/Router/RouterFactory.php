<?php

declare(strict_types=1);

namespace App\Router;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
    use Nette\StaticClass;

    public static function createRouter(): RouteList
    {
        $router = new RouteList;
        $router->addRoute('/api/<presenter>/<action>[/<id>]', ['module' => 'Api']);
        $router->addRoute('<presenter>/<action>[/<id>]', 'Articles:default');
        return $router;
    }
}
