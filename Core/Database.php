<?php

namespace Core;

use PDO;
use PDOStatement;

class Database
{
    public PDO $connection;
    public PDOStatement $statement;

    public function __construct(array $config, string $username = "root", string $password = "")
    {

        $dsn = "mysql:" . http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    private function setTimezone()
    {
        $this->statement = $this->connection->prepare("SET time_zone = '+08:00'");
        $this->statement->execute();
    }

    public function query(string $query, array $params = []): self
    {
        try {
            $this->setTimezone();
            $this->statement = $this->connection->prepare($query);
            $this->statement->execute($params);
            return $this;
        } catch (\PDOException $e) {
            Session::flash('toastMsg', $e->getMessage());
            return $this;
        }
    }

    public function id(): int
    {
        return $this->connection->lastInsertId();
    }

    public function get(): array|false
    {
        return $this->statement->fetchAll();
    }

    public function find(): array|false
    {
        return $this->statement->fetch();
    }

    public function findOrFail(): array|null
    {
        $result = $this->find();

        // Page not found
        if (!$result) abort();

        return $result;
    }
}
