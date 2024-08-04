<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel;

use Exception;

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
        if (!isset($this->tableName)) {
            throw new Exception("You forget to set the table to fetch the data.");
        }
        
        $tableChunks = [];
        foreach ($this->inserts as $insertionsObjects) {
            $loopTableChunk = sprintf("DB::table('%s')->insert([", $this->tableName) . PHP_EOL;
            $loopTableChunk .= $insertionsObjects->getString() . PHP_EOL;
            $loopTableChunk .= "]);";
            $tableChunks[] = $loopTableChunk;
        }
        
        return implode(PHP_EOL, $tableChunks);
    }
}
