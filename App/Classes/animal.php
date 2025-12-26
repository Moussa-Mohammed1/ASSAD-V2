<?php
class Animal
{
    private $nom;
    private $espece;
    private $alimentation;
    private $image;
    private $paysOrigine;
    private $descriptionCourte;
    private $id_habitat;

    public function __construct( $nom = "", $espece = "", $alimentation = "", $image = "", $paysOrigine = "", $descriptionCourte = "", $id_habitat = "")
    {
        $this->nom = $nom;
        $this->espece = $espece;
        $this->alimentation = $alimentation;
        $this->image = $image;
        $this->paysOrigine = $paysOrigine;
        $this->descriptionCourte = $descriptionCourte;
        $this->id_habitat = $id_habitat;
    }

    public function getAnimals()
    {
        $pdo = new Database();
        $sql = 'SELECT a.*, h.nom FROM animal a LEFT JOIN habitat h ON a.id_habitat = h.id_habitat';
        $pdo->query($sql);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            $result = $pdo->get();
            return $result;
        } else {
            return null;
        }
    }

    public function addAnimal()
    {
        $pdo = new Database();
        $sql = 'INSERT INTO animal(nom,espece ,alimentation,`image` ,paysorigine ,`description`,id_habitat)
                    VALUES(:nom, :espece, :alim, :img, :pays, :descr, :idh)';
        $pdo->query($sql);
        $pdo->bind(':nom', $this->nom);
        $pdo->bind(':espece', $this->espece);
        $pdo->bind(':alim', $this->alimentation);
        $pdo->bind(':img', $this->image);
        $pdo->bind(':pays', $this->paysOrigine);
        $pdo->bind(':descr', $this->descriptionCourte);
        $pdo->bind(':idh', $this->id_habitat);
        $pdo->execute();
    }

    public function updateAnimal($id_animal, $nom, $espece, $alimentation, $image, $paysOrigine, $descriptionCourte, $id_habitat)
    {
        $pdo = new Database();
        $sql = 'UPDATE 
                    animal 
                SET 
                    nom = :nom ,
                    espece = :esp ,
                    alimentation = :alim,
                    `image` = :img ,
                    paysorigine = :pay ,
                    `description` = :descr,
                    id_habitat = :idh 
                WHERE 
                    id_animal = :ida';

        $pdo->query($sql);
        $pdo->bind(':nom', $nom);
        $pdo->bind(':esp', $espece);
        $pdo->bind(':alim', $alimentation);
        $pdo->bind(':img', $image);
        $pdo->bind(':pay', $paysOrigine);
        $pdo->bind(':descr', $descriptionCourte);
        $pdo->bind(':idh', $id_habitat);
        $pdo->bind(':ida', $id_animal);
        $pdo->execute();
    }


    public function deleteAnimal($image){
        $pdo =  new Database();
        $sql = 'DELETE FROM animal WHERE `image` = :img';
        $pdo->query($sql);
        $pdo->bind(':img',$image);
        $pdo->execute();
    }

    public function filterHabitat($id_habitat)
    {
        $pdo = new Database();
        $sql = 'SELECT 
                    a.*, h.nom 
                FROM animal a
                LEFT JOIN habitat h ON a.id_habitat = h.id_habitat
                AND h.id_habitat = :idh';
        $pdo->query($sql);
        $pdo->bind(':idh', $id_habitat);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            $filtered = [] ;
            $filtered = $pdo->get();
            return $filtered;
        }
        else {
            return null;
        }
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setEspece($espece)
    {
        $this->espece = $espece;
    }

    public function setAlimentation($alimentation)
    {
        $this->alimentation = $alimentation;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function setPaysOrigin($paysOrigine)
    {
        $this->paysOrigine = $paysOrigine;
    }

    public function setDescription($descriptionCourte)
    {
        $this->descriptionCourte = $descriptionCourte;
    }

    public function setIdHabitat($id_habitat)
    {
        $this->id_habitat = $id_habitat;
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function getEspece()
    {
        return $this->espece;
    }
    public function getAlimentation()
    {
        return $this->alimentation;
    }
    public function getImage()
    {
        return $this->image;
    }
    public function getPaysOrigin()
    {
        return $this->paysOrigine;
    }
    public function getDescription()
    {
        return $this->descriptionCourte;
    }
    public function getIdHabitat()
    {
        return $this->id_habitat;
    }
}

