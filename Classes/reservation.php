<?php
    include './../Config/config.php';
    class Reservation
    {
        private $id_reservation;
        private $id_visite;
        private $id_user;
        private $nbr_personne;
        private $date_reservation;

        public function __construct($id_visite = "", $id_user = "", $nbr_personne = "", $date_reservation = "")
        {
            $this->id_visite = $id_visite;
            $this->id_user = $id_user;
            $this->nbr_personne = $nbr_personne;
            $this->date_reservation = $date_reservation;
        }

        public function reserver()
        {
            $pdo = new Database();
            $sql = 'INSERT INTO reservation (id_visite ,id_user , nbpersonnes ,datereservations) 
                    VALUES (:idv, :idu, :nbrp, :datere)'; 
            $pdo->query($sql);
            $pdo->bind(':idv', $this->id_visite);
            $pdo->bind(':idu', $this->id_user);
            $pdo->bind(':nbrp', $this->nbr_personne);
            $pdo->bind(':datere', $this->date_reservation);
            $pdo->execute();
        }

        public function consulterReservation($id_reservation)
        {
            $pdo = new Database();
            $sql = 'SELECT 
                        u.nom,
                        v.titre,
                        r.nbpersonnes,
                        r.datereservations
                    FROM reservastions r
                    INNER JOIN utilisateur u ON r.id_user = u.id_user
                    INNER JOIN visitesguidees v ON r.id_visite = v.id_visite
                    WHERE r.id_reservations = :id';
            $pdo->query($sql);
            $pdo->bind(':id', $id_reservation);
            $pdo->execute();
        }
    }