<?php
class EtapesVisites
{
    private $id_etape;
    private $titreEtape;
    private $descriptionEtape;
    private $ordreEtape;
    private $id_visite;

    public function  __construct($titreEtape = "", $descriptionEtape = "", $ordreEtape = "", $id_visite = "")
    {
        $this->titreEtape = $titreEtape;
        $this->descriptionEtape = $descriptionEtape;
        $this->ordreEtape = $ordreEtape;
        $this->id_visite = $id_visite;
    }

    public function addEtape()
    {
        $pdo = new Database();
        $sql = 'INSERT INTO etapesvisite(titreetape ,descriptionetape ,ordreetape ,id_visite)
                VALUES (:titre, :descr, :ordre, :idv)';
        $pdo->query($sql);
        $pdo->bind(':titre', $this->titreEtape);
        $pdo->bind(':descr', $this->descriptionEtape);
        $pdo->bind(':ordre', $this->ordreEtape);
        $pdo->bind(':idv', $this->id_visite);
        $pdo->execute();
    }

    public function getNextOrder($id_visite) {
        $pdo = new Database();
        $sql = 'SELECT MAX(ordreetape) as max_order FROM etapesvisite WHERE id_visite = :idv';
        $pdo->query($sql);
        $pdo->bind(':idv', $id_visite);
        $result = $pdo->single();
        return  $result->max_order ? $result->max_order + 1 : 1;
    }

    public function getEtapesByvisiteId($id_visite){
        $pdo = new Database();
        $sql = 'SELECT * FROM etapesvisite WHERE id_visite = :idv ORDER BY ordreetape ASC';
        $pdo->query($sql);
        $pdo->bind(':idv', $id_visite);
        $pdo->execute();
        $etapes = $pdo->get();
        return $etapes;
    }

    public function deleteEtape($id_etape) {
        $pdo = new Database();
        $sql = 'DELETE FROM etapesvisite WHERE id_etape = :id';
        $pdo->query($sql);
        $pdo->bind(':id', $id_etape);
        $pdo->execute();
    }
}