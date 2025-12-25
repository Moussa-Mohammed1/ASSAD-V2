<?php

use LDAP\Result;

include './../config/config.php';

class Utilisateur
{
    protected $id;
    protected $nom;
    protected $email;
    protected $role;
    protected $MotPasseHash;
    protected $error = [];


    public function __construct($nom, $email, $role, $MotPasseHash)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->role = $role;
        $this->MotPasseHash = $MotPasseHash;
    }

    public function signIn($email, $MotPasseHash)
    {
        $pdo = new Database();
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $pdo->query($sql);
        $pdo->bind(':email', $email);
        $pdo->execute();
        $result = $pdo->single();
        if ($result && password_verify($MotPasseHash, $result->motpasse_hash)) {
            return $result;
        } else {
            return null;
        }
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setMotPasseHash($MotPasseHash)
    {
        $this->MotPasseHash = $MotPasseHash;
    }

    public function getMotPasseHash()
    {
        return $this->MotPasseHash;
    }
}
