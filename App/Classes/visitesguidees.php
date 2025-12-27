<?php
class VisitesGuidees
{
    private $id_visite;
    private $id_guide;
    private $titre;
    private $dateHeure;
    private $langue;
    private $capaciteMax;
    private $status;
    private $duree;
    private $prix;

    public function __construct($id_guide = "", $titre = "", $dateHeure = "", $langue = "", $capaciteMax = "", $status = "", $duree = "", $prix = "")
    {
        $this->id_guide = $id_guide;
        $this->titre = $titre;
        $this->dateHeure = $dateHeure;
        $this->langue = $langue;
        $this->capaciteMax = $capaciteMax;
        $this->status = $status;
        $this->duree = $duree;
        $this->prix = $prix;
    }

    public function getAllVisitesByGuide($id_guide)
    {
        $pdo = new Database();
        $sql = 'SELECT * FROM visitesguidees WHERE id_user = :idu';
        $pdo->query($sql);
        $pdo->bind(':idu', $id_guide);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            $visites = [];
            $visites = $pdo->get();
            return $visites;
        } else {
            return null;
        }
    }
    public function getAllVisites($status = null)
    {
        $pdo = new Database();
        if ($status) {
            $sql = 'SELECT * FROM visitesguidees WHERE `status` = :stat';
            $pdo->query($sql);
            $pdo->bind(':stat', $status);
            $pdo->execute();
            if ($pdo->rowCount() > 0) {
                $visites = [];
                $visites = $pdo->get();
                return $visites;
            } else {
                return null;
            }
        } else {
            $sql = 'SELECT * FROM visitesguidees';
            $pdo->query($sql);
            $pdo->execute();
            if ($pdo->rowCount() > 0) {
                $visites = [];
                $visites = $pdo->get();
                return $visites;
            } else {
                return null;
            }
        }
    }

    public function getVisiteById($id_visite)
    {
        $pdo = new Database();
        $sql = 'SELECT * FROM visitesguidees WHERE id_visite = :id';
        $pdo->query($sql);
        $pdo->bind(':id', $id_visite);
        return $pdo->single();
    }

    public function addVisite()
    {
        $pdo = new Database();
        $sql = 'INSERT INTO visitesguidees(titre, dateheure, langue, capacite_max, `status`, duree, prix, id_user)
                VALUES (:titre, :dateh, :lang, :max, :stat, :duree, :prix, :idg)';
        $pdo->query($sql);
        $pdo->bind(':titre', $this->titre);
        $pdo->bind(':dateh', $this->dateHeure);
        $pdo->bind(':lang', $this->langue);
        $pdo->bind(':max', $this->capaciteMax);
        $pdo->bind(':stat', $this->status);
        $pdo->bind(':duree', $this->duree);
        $pdo->bind(':prix', $this->prix);
        $pdo->bind(':idg', $this->id_guide);
        $pdo->execute();
    }

    public function updateVisite($id_visite, $titre, $dateHeure, $langue, $capaciteMax, $status, $duree, $prix)
    {
        $pdo = new Database();
        $sql = 'UPDATE visitesguidees
                SET 
                    titre = :titre, 
                    dateheure = :dateh,
                    langue = :lang,
                    capacite_max = :max,
                    `status` = :stat,
                    duree = :duree, 
                    prix = :prix
                WHERE id_visite = :idv';
        $pdo->query($sql);
        $pdo->bind(':idv', $id_visite);
        $pdo->bind(':titre', $titre);
        $pdo->bind(':dateh', $dateHeure);
        $pdo->bind(':lang', $langue);
        $pdo->bind(':max', $capaciteMax);
        $pdo->bind(':stat', $status);
        $pdo->bind(':duree', $duree);
        $pdo->bind(':prix', $prix);
        $pdo->execute();
    }

    public function annulerVisite($id_visite)
    {
        $pdo = new Database();
        $sql = 'UPDATE visitesguidees
                SET `status` = CANCELED
                WHERE id_visite = :idv';
        $pdo->query($sql);
        $pdo->bind(':idv', $id_visite);
        $pdo->execute();
    }

    public function rechercherVisite($titre)
    {
        $pdo = new Database();
        $sql = 'SELECT * FROM visitesguidees
                WHERE titre = :titre';
        $pdo->query($sql);
        $pdo->bind(':title', $titre);
        $pdo->execute();
        if ($pdo->rowCount() == 1) {
            $search  = $pdo->single();
            return $search;
        } else {
            return null;
        }
    }

    public function cancelVisite($id_visite)
    {
        $pdo = new Database();
        $sql = "UPDATE visitesguidees SET status = 'CANCELLED' WHERE id_visite = :idv";
        $pdo->query($sql);
        $pdo->bind(':idv', $id_visite);
        $pdo->execute();
    }
}
