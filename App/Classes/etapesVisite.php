<?php
class EtapesVisites
{
    private $id_etape;
    private $titreEtape;
    private $descriptionEtape;
    private $ordreEtape;
    private $id_visite;

    public function  __construct($titreEtape, $descriptionEtape, $ordreEtape, $id_visite)
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
                VALUES (:titre, :descr, :ordre, :idv ';
        $pdo->query($sql);
        $pdo->bind(':titre', $this->titreEtape);
        $pdo->bind(':descr', $this->descriptionEtape);
        $pdo->bind(':ordre', $this->ordreEtape);
        $pdo->bind(':idv', $this->id_visite);
        $pdo->execute();
    }
}