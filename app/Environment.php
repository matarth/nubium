<?php

namespace App;

final class Environment
{

    public CONST dev = 'dev';
    public CONST test = 'test';

    private string $environment;
    private static ?Environment $instance = null;

    private function __construct(string $env)
    {

        $env = empty($env) ? getenv('PHP_ENV_MODE') : $env;

        if(!is_string($env)) {
            throw new \Exception("Invalid environment variable");
        }

        $this->environment = $env;
        if(!in_array($this->environment, [self::dev, self::test])) {
            throw new \Exception("Invalid environment variable $this->environment");
        }
    }

    public static function getInstance(string $env = ''): ?self
    {
        if(is_null(Environment::$instance)) {
            self::$instance = new Environment($env);
        }

        return self::$instance;
    }

    public function getEnvironment(): string
    {
        return $this->environment;
    }

    public function isTest(): bool {
        return in_array($this->environment, ['dev', 'test']);
    }
}