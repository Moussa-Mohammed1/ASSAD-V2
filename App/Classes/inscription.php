<?php

class inscription extends Utilisateur
{

    public function __construct($nom, $email, $role, $MotPasseHash)
    {
        parent::__construct($nom, $email, $role, $MotPasseHash);
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
        $availableRoles = ['visitor', 'guide'];
        if (empty($this->role) || !in_array($this->role, $availableRoles)) {
            $errors['role'] = 'Please select a role';
        }
        return empty($errors) ? null : $errors;
    }

    public function signUp()
    {
        $pdo = new Database();
        $sql = 'INSERT INTO utilisateur (nom, email, `role`, motpasse_hash, isactive)
                VALUES (:nom, :email, :rol, :pass, :stat) ';
        $pdo->query($sql);
        $pdo->bind(':nom', $this->nom);
        $pdo->bind(':email', $this->email);
        $pdo->bind(':rol', $this->role);
        $pdo->bind(':pass', $this->MotPasseHash);
        $pdo->bind(':stat', true);
        $pdo->execute();
    }
}
