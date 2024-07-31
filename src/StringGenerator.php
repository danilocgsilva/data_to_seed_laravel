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
        $stringBuilder->setTableName($this->tableName);

        $insert = new Insert();
        $insert->addNameValuePair("CODIGO_DO_PRODUTO", 1000889, "expression");
        $insert->addNameValuePair("NOME_DO_PRODUTO", "Sabor da Montanha - 700 ml - Uva", "string");
        $insert->addNameValuePair("EMBALAGEM", "Garrafa", "string");

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
