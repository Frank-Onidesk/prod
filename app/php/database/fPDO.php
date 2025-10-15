<?php

/**
 * Classe fPDO para conexão PDO com MySQL remoto
 */
class fPDO
{
    private PDO $conn;
    private array $dbInfo;
    private static ?fPDO $instance = null;

    /**
     * Construtor privado para singleton
     */
    private function __construct(array $dbInfo)
    {
        $this->dbInfo = $dbInfo;
        $this->connect();
    }

    /**
     * Método para obter a instância única da classe
     */
    public static function getInstance(array $dbInfo): fPDO
    {
        if (self::$instance === null) {
            self::$instance = new self($dbInfo);
        }
        return self::$instance;
    }

    /**
     * Conecta ao banco remoto via PDO
     */
    private function connect(): void
    {
        $dsn = "mysql:host={$this->dbInfo['host']};dbname={$this->dbInfo['dbname']};charset=utf8mb4";

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->conn = new PDO(
                $dsn,
                $this->dbInfo['username'],
                $this->dbInfo['password'],
                $options
            );
        } catch (PDOException $e) {
            throw new Exception("Erro ao conectar ao MySQL remoto: " . $e->getMessage());
        }
    }

    /**
     * Retorna a conexão PDO
     */
    public function getConnection(): PDO
    {
        return $this->conn;
    }

    /**
     * Fecha a conexão (opcional, PDO fecha automaticamente ao finalizar)
     */
    public function close(): void
    {
        $this->conn = null;
        self::$instance = null;
    }
}
 