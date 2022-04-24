<?php
namespace CT275\Labs;
use PDO;
use PDOException;
class PDOFactory
{
    public function create(array $config)
    {
        try {
            $dbhost = $config['dbhost'];
            $dbname = $config['dbname'];
            $dbuser = $config['dbuser'];
            $dbpass = $config['dbpass'];
            $dsn = "mysql:host={$dbhost};dbname={$dbname};charset=utf8mb4";
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
            return new PDO($dsn, $dbuser, $dbpass, $options);
        } catch (PDOException $ex) {
            return null;
        }
    }
}