<?php

declare(strict_types=1);

namespace Geoff\Database;

class QueryBuilder
{
    /**
     * @var string[]
     */
    private $stack = [];

    public function __construct(
        private Model $model
    ) {
    }

    /**
     * Select specific columns from the table.
     *
     * @param string ...$args
     * @return $this
     */
    public function select(string ...$args): QueryBuilder
    {
        $this->stack['select'] = $args;

        return $this;
    }

    /**
     * Add a where clause to the query.
     *
     * @param string $column
     * @param string $operator
     * @param string|int $value
     * @return $this
     */
    public function where(string $column, string $operator, string|int $value): QueryBuilder
    {
        $this->stack['where'][] = [
            'column' => $column,
            'operator' => $operator,
            'value' => $value,
        ];

        return $this;
    }

    /**
     * Get the SQL query.
     *
     * @return string
     */
    public function sql(): string
    {
        $sql = 'SELECT ' .
            ($this->stack['select'] ?? null
                ? implode(', ', $this->stack['select'])
                : '*')
            . ' FROM ' . $this->model->getTableName();

        if (isset($this->stack['where'])) {
            $sql .= ' WHERE ';

            foreach ($this->stack['where'] as $index => $where) {
                if ($index > 0) {
                    $sql .= ' AND ';
                }

                $sql .= $where['column'] . ' ' . $where['operator'] . ' ' . $this->sqlUnitCaster($where['value']);
            }
        }

        return $sql;
    }

    /**
     * Get the results of the query.
     *
     * @return array
     */
    public function get(): array
    {
        $sql = $this->sql();

        $stmt = $this->model->connection()->query($sql);

        $collection = [];
        while ($row = $stmt->fetchObject()) {
            $collection[] = $row;
        }

        return $collection;
    }

    /**
     * Cast potential string to sql string.
     *
     * @param $value
     * @return string
     */
    private function sqlUnitCaster($value): string
    {
        if (is_string($value)) {
            return '"' . str_replace('"', '\"', $value) . '"';
        }

        return (string) $value;
    }
}