<?php

namespace App\Repository;

use App\Etc\Databasse\MysqlDatabasse;

/**
 * Class AbstractRepository
 * @package App\Repository
 */
class AbstractRepository
{
    /**
     * @return \PDO
     */
    protected function getBdd()
    {
        $getPDO = new MysqlDatabasse();
        $pdo = $getPDO->getPDO();
        return $pdo;
    }
}