<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel;

use Config;
use Danilocgsilva\Database\{Discover, Field};
use PDO;
use PDOStatement;

class StringGenerator
{
    private string $databaseName;

    private string $tableName;

    private string $databasePassword;

    private string $databaseHost;

    private string $databaseUser;

    private Discover $databaseDiscover;

    private PDO $pdo;

    public function __construct()
    {
        $databaseConfigurationData = Config::get('database.connections.mysql');

        $this->databasePassword = $databaseConfigurationData["password"];
        $this->databaseHost = $databaseConfigurationData["host"];
        $this->databaseUser = $databaseConfigurationData["username"];
    }

    public function generate(): string
    {
        $this->pdo = new PDO(
            sprintf("mysql:host=%s;dbname=%s", $this->databaseHost, $this->databaseName),
            $this->databaseUser,
            $this->databasePassword
        );

        $this->databaseDiscover = (new Discover())->setPdo($this->pdo);
        
        $stringBuilder = new StringBuilder();
        $stringBuilder->setTableName($this->tableName);

        $databaseFieldsName = array_map(
            fn (Field $field) => $field->getName(), 
            iterator_to_array(
                $this->databaseDiscover->getFieldsFromTable($this->tableName)
            )
        );

        $fetchingLoop = $this->getData($databaseFieldsName);
        while ($rowData = $fetchingLoop->fetch()) {
            $insert = new Insert();
            foreach ($databaseFieldsName as $key => $fieldName) {
                $insert->addNameValuePair($fieldName, $rowData[$key], "string");
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

    private function getData(array $fields): PDOStatement
    {
        $fieldsmember = implode(", ", $fields);
        $query = "SELECT " . $fieldsmember . " FROM " . $this->tableName . ";";
        $preResults = $this->pdo->prepare($query);
        $preResults->execute();
        $preResults->setFetchMode(PDO::FETCH_NUM);
        return $preResults;
    }
}
