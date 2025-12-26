<?php


class Utilisateur
{
    protected $id;
    protected $nom;
    protected $email;
    protected $role;
    protected $MotPasseHash;

    public function __construct($nom = "", $email = "", $role = "", $MotPasseHash = "")
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

    public function getAllRegistered()
    {
        $pdo = new Database();
        $sql = 'SELECT * FROM utilisateur WHERE `role` != :rol';
        $pdo->query($sql);
        $pdo->bind(':rol', 'NOTAPPROVED');
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            $users = [];
            $users = $pdo->get();
            return $users;
        } else {
            return null;
        }
    }

    public function getUsersByApproval($status = null)
    {
        $pdo = new Database();
        if ($status !== null) {
            $sql = 'SELECT * FROM utilisateur WHERE approved = :stat  AND `role` = :rol';
            $pdo->query($sql);
            $pdo->bind(':stat', $status);
            $pdo->bind(':rol', 'guide');
            $pdo->execute();
            if ($pdo->rowCount() > 0) {
                $users = [];
                $users = $pdo->get();
                return $users;
            } else {
                return null;
            }
        } else {
            $sql = 'SELECT * FROM utilisateur';
            $pdo->query($sql);
            $pdo->execute();
            if ($pdo->rowCount() > 0) {
                $users = [];
                $users = $pdo->get();
                return $users;
            } else {
                return null;
            }
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
