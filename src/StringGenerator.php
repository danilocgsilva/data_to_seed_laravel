<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel;

use Config;

class StringGenerator
{
    private string $database;

    public function __construct()
    {
        var_dump(Config::get('database.connections.mysql'));
    }
    
    public function setDatabase(string $database): self
    {
        $this->database = $database;
        return $this;
    }
    
    public function generate(): string
    {
        return "Hello world!";
    }
}
