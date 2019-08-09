<?php
declare(strict_types=1);

namespace App\Models;

use Doctrine\DBAL\Connection;

class Retrieve
{
    private $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @param string $id
     * @return array
     * @throws \Doctrine\DBAL\DBALException
     */
    public function getValue(string $id): array
    {
        $stmt = $this->connection->executeQuery('SELECT value FROM rand WHERE id IN (?)',
            [[$id]],
            [$this->connection::PARAM_INT_ARRAY]
            );
        $result = $stmt->fetchAll();
        return $result;
    }
}