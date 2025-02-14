<?php

declare(strict_types=1);

namespace Geoff\Database;

use PDO;

use function Geoff\Environment\env;

class Connection
{
    public function __construct(
        private PDO $pdo
    ) {
    }

    public static function connect(): Connection
    {
        $dsn = env('DB_CONNECTION') . ':host=' . env('DB_HOST') . ';dbname=' . env('DB_DATABASE');
        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');

        return new Connection(new PDO($dsn, $username, $password));
    }

    public function query(string $sql, array $params = []): \PDOStatement
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }
}