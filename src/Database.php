<?php

class Database {
    private $connection;

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

    private function convertQueryArrToStr($field_name)
    {
        return is_array($field_name) ? implode(', ', $field_name) : $field_name;
    }
}