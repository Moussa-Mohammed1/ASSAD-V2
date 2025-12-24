<?php

use LDAP\Result;

    include './../config/config.php';

    class Utilisateur 
    {
        protected Database $pdo;
        protected $id;
        protected $nom;
        protected $email;
        protected $role;
        protected $MotPasseHash;
        protected $error = [];


        public function __construct(Database $pdo, $nom, $email, $role, $MotPasseHash)
        {
            $this->pdo = $pdo;
            $this->nom = $nom;
            $this->email = $email;
            $this->role = $role;
            $this->MotPasseHash = $MotPasseHash;
        }

        public function signIn($email, $MotPasseHash){
            $sql = 'SELECT * FROM utilisateur WHERE email = :email';
            $pdo = $this->pdo;
            $pdo->query($sql);
            $pdo->bind(':email', $email);
            $pdo->execute();
            $result = $pdo->single();
            if ($result && password_verify($MotPasseHash, $result->motpasse_hash)) {
                return $result;
            }
            else {
                return null;
            }
        }
    }