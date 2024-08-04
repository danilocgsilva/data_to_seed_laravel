<?php

declare(strict_types=1);

namespace Danilocgsilva\DataToSeedLaravel\Tests;

use Danilocgsilva\DataToSeedLaravel\Insert;
use Danilocgsilva\DataToSeedLaravel\StringBuilder;
use PHPUnit\Framework\TestCase;
use Exception;

class StringBuilderTest extends TestCase
{
    private StringBuilder $stringBuilder;

    public function setUp(): void
    {
        $this->stringBuilder = new StringBuilder();
    }

    public function testGetForgetSetTable(): void
    {
        $this->expectException(Exception::class);

        $insert = new Insert();
        $insert->addNameValuePair("name", "str_random(10)", "expression");
        $insert->addNameValuePair("email", "str_random(10).'@gmail.com'", "expression");
        $insert->addNameValuePair("password", "bcrypt('secret')", "expression");

        $this->stringBuilder->addInsert($insert);

        $this->stringBuilder->get();
    }

    public function test1Get(): void
    {
        $this->stringBuilder->setTableName("Users");

        $insert = new Insert();
        $insert->addNameValuePair("name", "str_random(10)", "expression");
        $insert->addNameValuePair("email", "str_random(10).'@gmail.com'", "expression");
        $insert->addNameValuePair("password", "bcrypt('secret')", "expression");

        $this->stringBuilder->addInsert($insert);

        $expectedString = <<<EOF
DB::table('Users')->insert([
    'name' => str_random(10),
    'email' => str_random(10).'@gmail.com',
    'password' => bcrypt('secret'),
]);
EOF;
        $this->assertSame(
            $expectedString,
            $this->stringBuilder->get()
        );
    }

    public function test2Get(): void
    {
        $this->stringBuilder->setTableName("QUsers");

        $insert = new Insert();
        $insert->addNameValuePair("name", "Olivia", "string");
        $insert->addNameValuePair("surname", "Lane", "string");
        $insert->addNameValuePair("company", "qiskit", "string");

        $this->stringBuilder->addInsert($insert);

        $expectedString = <<<EOF
DB::table('QUsers')->insert([
    'name' => 'Olivia',
    'surname' => 'Lane',
    'company' => 'qiskit',
]);
EOF;
        $this->assertSame(
            $expectedString,
            $this->stringBuilder->get()
        );
    }

    public function testSeveralinserts()
    {
        $this->stringBuilder->setTableName("juices");

        $insert = new Insert();
        $insert->addNameValuePair("product_code", "1000889", "string");
        $insert->addNameValuePair("product_name", "Montain taste - 700 ml - Grape", "string");
        $insert->addNameValuePair("packing", "Bottle", "string");

        $this->stringBuilder->addInsert($insert);

        $insert = new Insert();
        $insert->addNameValuePair("product_code", "1002334", "string");
        $insert->addNameValuePair("product_name", "Citrus Line - 1 L - Lemon", "string");
        $insert->addNameValuePair("packing", "PET", "string");

        $this->stringBuilder->addInsert($insert);

        $expectedString = <<<EOF
DB::table('juices')->insert([
    'product_code' => '1000889',
    'product_name' => 'Montain taste - 700 ml - Grape',
    'packing' => 'Bottle',
]);
DB::table('juices')->insert([
    'product_code' => '1002334',
    'product_name' => 'Citrus Line - 1 L - Lemon',
    'packing' => 'PET',
]);
EOF;
        $this->assertSame(
            $expectedString,
            $this->stringBuilder->get()
        );
    }
}
