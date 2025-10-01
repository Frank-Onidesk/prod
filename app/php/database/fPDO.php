<?php

/**
 * Classe para lidar e manipular dados
 */

class fPDO
{


    private PDO $conn;

    public array $dbInfo;
    private static  ?fPDO $instance = null;


    public function __construct(array $dbInfo)
    {
        $this->dbInfo = $dbInfo;
    }



    public function connect()
    {
        if (!$this->getInstance($dbInfo)) {

            $this->conn = new PDO($dsn,);

            try {
            } catch (Exception $e) {
                throw new Exception("Mysql Connection Error "  . $e->getMessage());
            }
        }
    }

    public static function  getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self($this->dbInfo);
        }

        return self::$instance;
    }


    public function getConnection() : PDO
    {
        return $this->conn;
    }

    
    public function close() {}
}
