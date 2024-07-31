<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel\Tests;

use Danilocgsilva\DataToSeedLaravel\Insert;
use PHPUnit\Framework\TestCase;

class InsertTest extends TestCase
{
    /**
     * @var Insert
     */
    private Insert $insert;
    
    public function setUp(): void
    {
        $this->insert = new Insert();
    }
    
    public function test1GetString(): void
    {
        $this->insert->addNameValuePair("name", "str_random(10)", "expression");
        
        $expectedString = "    'name' => str_random(10),";
        
        $this->assertSame($expectedString, $this->insert->getString());
    }

    public function test2GetString(): void
    {
        $this->insert->addNameValuePair("CODIGO_DO_PRODUTO", 1000889, "expression");
        $this->insert->addNameValuePair("NOME_DO_PRODUTO", "Sabor da Montanha - 700 ml - Uva", "string");
        $this->insert->addNameValuePair("EMBALAGEM", "Garrafa", "string");

        $expectedString = <<<EOF
    'CODIGO_DO_PRODUTO' => 1000889,
    'NOME_DO_PRODUTO' => 'Sabor da Montanha - 700 ml - Uva',
    'EMBALAGEM' => 'Garrafa',
EOF;
        $this->assertSame(
            $expectedString,
            $this->insert->getString()
        );
    }
}
