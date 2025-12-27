<?php
class Habitat
{
    private $id_habitat;
    private $nom;
    private $typeClimat;
    private $description;
    private $zonezoo;

    public function __construct($nom = "", $typeClimat = "", $description = "", $zonezoo = "")
    {
        $this->nom = $nom;
        $this->typeClimat  = $typeClimat;
        $this->description = $description;
        $this->zonezoo = $zonezoo;
    }

    public function addHabitat()
    {
        $pdo = new Database();
        $sql = 'INSERT INTO habitat(nom, typeclimat, `description`, zonezoo)
                    VALUES (:nom, :typec, :descr, :zonez)
                    ';
        $pdo->query($sql);
        $pdo->bind(':nom', $this->nom);
        $pdo->bind(':typec', $this->typeClimat);
        $pdo->bind(':descr', $this->description);
        $pdo->bind(':zonez', $this->zonezoo);
        $pdo->execute();
    }

    public function updateHabitat($id_habitat, $nom, $description, $typeClimat, $zonezoo)
    {
        $pdo = new Database();
        $sql = 'UPDATE habitat SET 
                                    nom = :nom,   
                                    typeclimat = :typec, 
                                    `description` = :descr, 
                                    zonezoo = :zonez
                                    WHERE id_habitat = :idh';
        $pdo->query($sql);
        $pdo->bind(':nom', $nom);
        $pdo->bind(':typec', $typeClimat);
        $pdo->bind(':descr', $description);
        $pdo->bind(':zonez', $zonezoo);
        $pdo->bind(':idh', $id_habitat);
        $pdo->execute();
    }

    public function deleteHabitat($id_habitat)
    {
        $pdo = new Database();
        $sql = 'DELETE FROM habitat WHERE id_habitat = :idh';
        $pdo->query($sql);
        $pdo->bind(':idh', $id_habitat);
        $pdo->execute();
    }

    public function getHabitats()
    {
        $pdo = new Database();
        $sql = 'SELECT h.*, COUNT(a.id_animal) as animal_count 
                FROM habitat h 
                LEFT JOIN animal a ON h.id_habitat = a.id_habitat 
                GROUP BY h.id_habitat';
        $pdo->query($sql);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            $habitats = [];
            $habitats = $pdo->get();
            return $habitats;
        } else {
            return null;
        }
    }
}
