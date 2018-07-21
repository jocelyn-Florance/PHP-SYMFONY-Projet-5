<?php
namespace App\Etc\Databasse;

use PDO;

class MysqlDatabasse
{
    /**
     * @return PDO
     */
    public function getPDO(){
        $config = require __DIR__ . './../../../config/database/Mysql.php';
        try {
            return new PDO(
                'mysql:host='.  $config['host']  .';dbname=' . $config['db_name'] . '',
                $config['db_user'],
                $config['db_pass'],
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }
}