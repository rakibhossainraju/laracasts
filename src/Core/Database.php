<?php
namespace Core;
use InvalidArgumentException;
use PDO;
use PDOException;
class Database {
    private PDO $connection;

    public function __construct($config, $username = 'learn_user', $password = 'password')
    {
        $dsn = "mysql:" . http_build_query($config, "", ";");

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function queryAll($query = "")
    {
       $statement = $this->connection->prepare($query);
       $statement->execute();

       return $statement->fetchAll();
    }

    public function queryOne($query_data = [])
    {
        $query_string = "SELECT {$this->convertQueryArrToStr($query_data['field_name'])}
                         FROM {$query_data['table_name']}
                         WHERE {$query_data['condition_name']} {$query_data['condition']} ?";
        $statement = $this->connection->prepare($query_string);

        $statement->execute([$query_data['condition_value']]);

        return $statement->fetch();
    }
   // Insert one row into the table
    public function insert($query_data = []): bool|string
    {
        try {
            $query_string = "INSERT INTO {$query_data['table_name']} ({$this->convertQueryArrToStr($query_data['field_names'])})
                             VALUES ({$this->convertQueryArrToStr(array_fill(0, count($query_data['field_names']), '?'))})";
            $statement = $this->connection->prepare($query_string);

            $statement->execute($query_data['values']);
            return $statement->rowCount() > 0; // Returns true if the row was inserted successfully
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function deleteOne(array $query_data): bool
    {
        try {
            // Basic validation
            if (!isset($query_data['table_name'], $query_data['condition_name'], $query_data['condition'], $query_data['condition_value'])) {
                throw new InvalidArgumentException("Missing required query data.");
            }

            // Escape table and column names with backticks
            $table_name = "`{$query_data['table_name']}`";
            $condition_name = "`{$query_data['condition_name']}`";

            $query_string = "DELETE FROM $table_name WHERE $condition_name {$query_data['condition']} ?";

            $statement = $this->connection->prepare($query_string);
            $statement->execute([$query_data['condition_value']]);
            return true;
        } catch (PDOException $e) {
            // Log error message if necessary
            error_log($e->getMessage());
            return false;
        } catch (InvalidArgumentException $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    private function convertQueryArrToStr($field_name)
    {
        return is_array($field_name) ? implode(', ', $field_name) : $field_name;
    }
}