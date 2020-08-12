<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/11/20
 * Time: 8:44 PM
 */

trait DatabaseConn
{
    private \PDO $pdo;

    public function __construct()
    {
        $dsn = 'mysql:dbname=payments_db;host=127.0.0.1';
        $user = 'root';
        $password = '';

        try {
            $this->pdo = new \PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo 'Подключение не удалось: ' . $e->getMessage();
        }
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}