<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel;

class Insert
{
    private array $nameValuePairs;
    
    public function addNameValuePair(string $name, string $value, string $valueType): self
    {
        $this->nameValuePairs[] = [$name, $value, $valueType];
        return $this;
    }

    public function getString(): string
    {
        $returnStringArray = [];
        foreach ($this->nameValuePairs as $nameValuePair) {
            if ($nameValuePair[2] === "expression") {
                $returnStringArray[] = '    \'' . $nameValuePair[0] . '\' => ' . $nameValuePair[1] . ',';
            } elseif ($nameValuePair[2] === "string") {
                $returnStringArray[] = '    \'' . $nameValuePair[0] . '\' => \'' . $nameValuePair[1] . '\',';
            }
        }

        return implode(PHP_EOL, $returnStringArray);
    }
}
