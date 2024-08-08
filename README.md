# Usage example

```
use Danilocgsilva\DataToSeedLaravel\StringGenerator;
.
.
.

$stringGenerator = new StringGenerator();
        
$databaseName = "your_existing_database";
$tableName = "your_existing_table";

$stringGenerator->setDatabaseName($databaseName);
$stringGenerator->setTableName($tableName);

return $stringGenerator->generate();
```
Will generate the handle method content, like:
```
DB::table('your_existing_table')->insert([
    'CODIGO_DO_PRODUTO' => '1000889',
    'NOME_DO_PRODUTO' => 'Sabor da Montanha - 700 ml - Uva',
    'EMBALAGEM' => 'Garrafa',
    'TAMANHO' => '700 ml',
    'SABOR' => 'Uva',
    'PRECO_DE_LISTA' => '6.309',
]);
DB::table('your_existing_table')->insert([
    'CODIGO_DO_PRODUTO' => '1002334',
    'NOME_DO_PRODUTO' => 'Linha Citros - 1 Litro - Lima/Limão',
    'EMBALAGEM' => 'PET',
    'TAMANHO' => '1 Litro',
    'SABOR' => 'Lima/Limão',
    'PRECO_DE_LISTA' => '7.004',
]);
DB::table('your_existing_table')->insert([
    'CODIGO_DO_PRODUTO' => '1002767',
    'NOME_DO_PRODUTO' => 'Videira do Campo - 700 ml - Cereja/Maça',
    'EMBALAGEM' => 'Garrafa',
```
