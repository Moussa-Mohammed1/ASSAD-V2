<?php
class DBconnection
{
    private $host;
    private $dbname;
    private $user;
    private $pass;
    private $conn;
    public function __construct($host, $dbname, $user, $pass)
    {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->user = $user;
        $this->pass = $pass;
    }
    public function DBconnect()
    {
        try {
            $this->conn = new PDO(
                                    "mysql:host={$this->host};
                                    dbname={$this->dbname}",  
                                    $this->user, 
                                    $this->pass
            );
            // definir le mode d'erreur
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $error) {
            echo 'failed to connect: ' . $error->getMessage();
            return null;
        }
    }
}