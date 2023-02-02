<?php

namespace App;

final class Environment
{

    public CONST dev = 'dev';
    public CONST test = 'test';

    private string $environment;
    private static ?Environment $instance = null;

    private function __construct()
    {
        $env = getenv('PHP_ENV_MODE');

        if(!is_string($env)){
            throw new \Exception("Invalid environment variable");
        }

        $this->environment = $env;
        if(!in_array($this->environment, [self::dev, self::test])){
            throw new \Exception("Invalid environment variable $this->environment");
        }
    }

    public static function getInstance(): ?self
    {
        if(is_null(Environment::$instance)){
            self::$instance = new Environment();
        }

        return self::$instance;
    }

    public function getEnvironent(): string
    {
        return $this->environment;
    }
}