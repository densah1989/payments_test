<?php
/**
 * Created by PhpStorm.
 * User: den_sah
 * Date: 8/10/20
 * Time: 10:24 PM
 */

abstract class AbstractRepository
{
    use DatabaseConn;

    protected function save(string $query, array $statements): void
    {
        if (false === strpos($query, 'insert', 0)) {
            return;
        }
        $stmt = $this->getPdo()->query($query);
        $stmt->execute($statements);
    }
}