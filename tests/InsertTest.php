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
    
    public function test1GetString()
    {
        $this->insert->addNameValuePair("name", "str_random(10)", "string");
        
        $expectedString = "    'name' => str_random(10),";
        
        $this->assertSame($expectedString, $this->insert->getString());
    }
}
