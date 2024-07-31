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
}
