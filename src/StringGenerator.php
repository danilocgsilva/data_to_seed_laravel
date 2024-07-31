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

        $fields = $this->getFieldsFromTable($this->tableName);

        foreach ($this->getData() as $rowData) {
            $insert = new Insert();
            foreach ($fields as $field) {
                $fieldName = $field["name"];
                $insert->addNameValuePair($fieldName, $rowData[$field], $field["type"]);
            }
            $stringBuilder->addInsert($insert);
        }

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

    private function getFieldsFromTable()
    {
        
    }
}
