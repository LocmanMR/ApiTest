<?php
declare(strict_types=1);

require_once __DIR__ . '/../../../src/Models/Generate.php';

use PHPUnit\Framework\TestCase;
use Doctrine\DBAL\Connection;
use App\Models\Generate;

class GenerateTest extends TestCase
{

    /**
     * @param array $array
     * @throws \Doctrine\DBAL\DBALException
     * @dataProvider generator_DataProvider
     */
    public function test_generator(array $array): void
    {
        $connection = $this->createMock(Connection::class);
        $connection->method('prepare')->willReturn(new PDOStatement());
        $generateObj = new Generate($connection);
        $result = $generateObj->generator($array);
        $this->assertIsArray($result, 'Метод не вернул массив');
        $this->assertArrayHasKey('id', $result, 'Массив не содежит обязательного ключа');
        $this->assertArrayHasKey('value', $result, 'Массив не содежит обязательного ключа');
    }

    public function generator_DataProvider()
    {
        return [
            [['length' => '10', 'type'   => '3'],],
            [['length' => '5', 'type'   => '1'],],
            [['length' => '15', 'type'   => '2'],],
            [['length' => '20', 'type'   => '3'],],
            [['length' => '23', 'type'   => '4'],],
            [['length' => '10', 'type'   => 'qwerty'],],
        ];
    }
}