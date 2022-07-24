<?php

namespace MyProject\Services;

use PDOException;

class Db
{
    /** @var \PDO */
    private $pdo;
    private static $instance;
    private static $instancesCount = 0;
    private function __construct()
    {
        self::$instancesCount++;

        $dbOptions = (require __DIR__ . '\setting.php')['db'];
        $options = [
            \PDO::ATTR_ERRMODE            => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->pdo = new \PDO(
            'mysql:host=' . $dbOptions['host'] . ';dbname=' . $dbOptions['dbname'],
            $dbOptions['user'],
            $dbOptions['password'],
            $options,
        );
        $this->pdo->exec('SET NAMES utf8mb4');
    }

    public function query(string $sql, array $params = [], string $className = 'stdClass'): ?array
    {
        try {
        $sth = $this->pdo->prepare($sql);
        $result = $sth->execute($params);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
        if (false === $result) {
            return null;
        }

        return $sth->fetchAll(\PDO::FETCH_CLASS, $className);
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getLastInsertId(): int
    {
        return (int) $this->pdo->lastInsertId();
    }
}