<?php

namespace App\Core\Database;

use PDO;

class QueryBuilder
{
    /**
     * The PDO instance.
     *
     * @var PDO
     */
    protected PDO $pdo;

    /**
     * Create a new QueryBuilder instance.
     *
     * @param PDO $pdo
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Select all records from a database table.
     *
     * @param string $table
     * @param string[] $columns
     * @param string $mode
     * @return array|false
     */
    public function selectAll(string $table, array $columns = ['*'], string $mode = 'CLASS')
    {
        $columns = implode(',', $columns);
        $mode = $mode == 'CLASS' ? PDO::FETCH_CLASS : PDO::FETCH_COLUMN;

        $statement = $this->pdo->prepare("select {$columns} from {$table}");
        $statement->execute();

        return $statement->fetchAll($mode);
    }

    /**
     * Find One Record.
     *
     * @param string $table
     * @param string[] $columns
     * @param array $conditions
     * @return array|false
     */
    public function find(string $table, array $columns = ['*'], array $conditions = [])
    {
        $columns = implode(',', $columns);
        $query = "select {$columns} from {$table}";

        if (!empty($conditions)) {
            $query .= $this->processConditions($conditions);
        }

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $statement->fetchObject();
    }

    /**
     * Update Record.
     *
     * @param string $table
     * @param array $conditions
     * @param array $data
     * @return array|false
     */
    public function update(string $table, array $conditions, array $data)
    {
        $query = "UPDATE {$table}";

        if (!empty($data)) {
            $query .= $this->processData($data);
        }

        if (!empty($conditions)) {
            $query .= $this->processConditions($conditions);
        }

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        return $this->find($table, ['*'], ['id' => $conditions['id']]);
    }

    /**
     * Create a new record in the specified table.
     *
     * @param string $table The name of the table.
     * @param array $data The data to be inserted into the table.
     * @return array The newly created record.
     */
    public function create(string $table, array $data)
    {
        $keys = implode(', ', array_keys($data));
        $query = "INSERT INTO {$table} ({$keys})";
        $query .= $this->processInsertedData($data);

        $statement = $this->pdo->prepare($query);
        $statement->execute();

        $lastInsertId = $data['id'] != null ? $data['id'] : $this->pdo->lastInsertId();

        return $this->find($table, ['*'], ['id' => $lastInsertId]);
    }

    /**
     * Deletes records from a database table based on the given conditions.
     *
     * @param string $table The name of the table to delete records from.
     * @param array $conditions An associative array of conditions to filter the deletion.
     * @return bool True if the deletion was successful, false otherwise.
     */
    public function delete(string $table, array $conditions)
    {
        $query = "DELETE FROM {$table}";

        if (!empty($conditions)) {
            $query .= $this->processConditions($conditions);
        }

        $statement = $this->pdo->prepare($query);
        return $statement->execute();
    }

    /**
     * Execute an SQL statement.
     *
     * @param string $query
     * @return false|int
     */
    public function execute(string $query)
    {
        return $this->pdo->exec($query);
    }

    private function processConditions($conditions): string
    {
        $attributes = array_keys($conditions);

        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = '{$conditions[$attr]}'", $attributes));

        return " WHERE {$sql}";
    }

    private function processData($data): string
    {
        $attributes = array_keys($data);

        $sql = implode(", ", array_map(fn ($attr) => "$attr = '{$data[$attr]}'", $attributes));

        return " SET {$sql}";
    }

    private function processInsertedData($data): string
    {
        $attributes = array_keys($data);

        $sql = implode(", ", array_map(fn ($attr) => "'{$data[$attr]}'", $attributes));

        return " VALUES({$sql})";
    }
}
