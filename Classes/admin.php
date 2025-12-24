<?php
include './Config/config.php';
include './Classes/animal.php';
class Admin extends Utilisateur
{

    public function __construct(Database $pdo, $nom, $email, $role, $MotPasseHash)
    {
        $this->pdo = $pdo;
        $this->nom = $nom;
        $this->email = $email;
        $this->role = $role;
        $this->MotPasseHash = $MotPasseHash;
    }
    public function changeStatus($email)
    {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $pdo = $this->pdo;
        $pdo->query($sql);
        $pdo->bind(':email', $email);
        if ($pdo->rowCount() > 0) {
            $result = $pdo->single();
            if ($result->isactive = 1) {
                $sql = 'UPDATE utilisateur SET isactive = 0 WHERE email = :email';
                $pdo->query($sql);
                $pdo->bind(':email', $email);
                $pdo->execute();
            } else {
                $sql = 'UPDATE utilisateur SET isactive = 1 WHERE email = :email';
                $pdo->query($sql);
                $pdo->bind(':email', $email);
                $pdo->execute();
            }
        }
    }

    public function approve($email)
    {
        $sql = 'SELECT * FROM utilisateur WHERE email = :email';
        $pdo = $this->pdo;
        $pdo->query($sql);
        $pdo->bind(':email', $email);
        $pdo->execute();
        if ($pdo->rowCount() == 1) {
            $result = $pdo->single();
            if ($result->role = 'guide' && $result->approved == 0) {
                $sql = 'UPDATE utilisateur SET approved = 1 WHERE email = :email';
                $pdo = $this->pdo;
                $pdo->query($sql);
                $pdo->bind(':email', $email);
            } else {
                return null;
            }
        }
    }

    public function addAnimal(Animal $a)
    {
        $sql = 'INSERT INTO animal(nom,espece ,alimentation,`image` ,paysorigine ,`description`,id_habitat)
                    VALUES(:nom, :espece, :alim, :img, :pays, :descr, :idh)';
        $pdo = $this->pdo;
        $pdo->query($sql);
        $pdo->bind(':nom', $a->getNom());
        $pdo->bind(':espece', $a->getEspece());
        $pdo->bind(':alim', $a->getAlimentation());
        $pdo->bind(':img', $a->getImage());
        $pdo->bind(':pays', $a->getPaysOrigin());
        $pdo->bind(':descr', $a->getDescription());
        $pdo->bind(':idh', $a->getIdHabitat());
        $pdo->execute();
    }

    public function updateAnimal($id_animal, array $values){
        
    }
}
