<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel;

class StringBuilder
{
    private string $tableName;

    /** @var \Danilocgsilva\DataToSeedLaravel\Insert[] */
    private array $inserts;
    
    public function setTableName(string $tableName): self
    {
        $this->tableName = $tableName;
        return $this;
    }

    public function addInsert(Insert $insert): self
    {
        $this->inserts[] = $insert;
        return $this;
    }
    
    public function get(): string
    {
        $insertHeader = sprintf("DB::table('%s')->insert([", $this->tableName);
        $insertFooter = "]);";
        $insertBody = $this->inserts[0]->getString();
        
        return $insertHeader . PHP_EOL . $insertBody . PHP_EOL . $insertFooter;
    }
}
