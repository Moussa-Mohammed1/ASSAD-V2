<?php
    class Database
    {
        private $host = DB_HOST;
        private $dbname = DB_NAME;
        private $user = DB_USER;
        private $pass = DB_PASS;

        private $stmt;
        private $conn;

        public function __construct()
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
            } catch (PDOException $error) {
                die('failed to connect: ' . $error->getMessage());
            }
        }

        public function query($sql){
            $this->stmt = $this->conn->prepare($sql);
        }

        public function bind($param, $value, $type = null){
            if (is_null($type)) {
                switch ($value) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_string($value):
                    $type = PDO::PARAM_STR;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                default:
                    $type = PDO::PARAM_NULL;
                    break;
                }
            }
            $this->stmt->bindParam($param, $value, $type);
        }

        public function execute(){
            $this->stmt->execute();
        }

        // get all the result as an object 

        public function get(){
            $this->stmt->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // get one row 
        public function single(){
            $this->stmt->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        //get the numbers rows returned
        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }