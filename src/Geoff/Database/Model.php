<?php

declare(strict_types=1);

namespace Geoff\Database;

class Model
{
    protected string $primaryKey = 'id';
    protected ?string $table = null;
    protected ?Connection $connection = null;

    /**
     * Get table name.
     *
     * @return string
     */
    public function getTableName(): string
    {
        if ($this->table === null) {
            $this->table = strtolower((new \ReflectionClass($this))->getShortName()) . 's';
        }

        return $this->table;
    }

    /**
     * Start building a query.
     *
     * @return QueryBuilder
     */
    public static function query(): QueryBuilder
    {
        return new QueryBuilder(new static());
    }

    public function connection(): Connection
    {
        if ($this->connection === null) {
            $this->connection = Connection::connect();
        }

        return $this->connection;
    }
}