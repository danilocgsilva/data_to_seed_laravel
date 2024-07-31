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
        $returnString = "";
        foreach ($this->nameValuePairs as $nameValuePair) {
            $returnString .= '    \'' . $nameValuePair[0] . '\' => ' . $nameValuePair[1] . ',';
        }

        return $returnString;
    }
}
