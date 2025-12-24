<?php

include 'utilisateur.php';
class inscription extends Utilisateur
{

    public function __construct(Database $pdo, $nom, $email, $role, $MotPasseHash)
    {
        $this->pdo = $pdo;
        $this->nom = $nom;
        $this->email = $email;
        $this->role = $role;
        $this->MotPasseHash = $MotPasseHash;
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

    public function validateForm()
    {
        $errors = [];
        if (empty($this->nom) || !preg_match('/^[a-zA-Z\s]+$/', $this->nom)) {
            $errors['nom'] = 'Name must contains letters and spaces and not empty';
        }
        if (empty($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }
        $availableRoles = ['Visitor', 'guide'];
        if (empty($this->role) || !in_array($this->role, $availableRoles)) {
            $errors['role'] = 'Please select a role';
        }
        return empty($errors) ? true : $errors;
    }
}
