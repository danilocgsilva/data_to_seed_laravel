<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel;

use Config;

class StringGenerator
{
    private string $databaseName;

    private string $tableName;

    private string $databasePassword;

    private string $databaseHost;

    public function __construct()
    {
        $databaseConfigurationData = Config::get('database.connections.mysql');

        $this->databasePassword = $databaseConfigurationData["password"];
        $this->databaseHost = $databaseConfigurationData["host"];
    }
    
    public function generate(): string
    {
        $stringBuilder = new StringBuilder();

        return $stringBuilder->get();
    }

    public function setDatabaseName(string $databaseName): self
    {
        $this->databaseName = $databaseName;
        return $this;
    }

    public function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;
        return $this;
    }
}
