<?php
class Commentaire
{
    private $id_comment;
    private $id_visite;
    private $id_user;
    private $note;
    private $text;
    private $date_comment;

    public function __construct($id_visite = "", $id_user = "", $note = "", $text = "", $date_comment = "")
    {
        $this->id_visite = $id_visite;
        $this->id_user = $id_user;
        $this->note = $note;
        $this->text = $text;
        $this->date_comment = $date_comment;
    }

    public function addComment()
    {
        $pdo = new Database();
        $query = "INSERT INTO commentaire (id_visite, id_user, note, texte, date_commentaire) VALUES (:id_visite, :id_user, :note, :texte, :date_commentaire)";
        $pdo->query($query);
        $pdo->bind(':id_visite', $this->id_visite);
        $pdo->bind(':id_user', $this->id_user);
        $pdo->bind(':note', $this->note);
        $pdo->bind(':texte', $this->text);

        if (empty($this->date_comment)) {
            $this->date_comment = date('Y-m-d H:i:s');
        }
        $pdo->bind(':date_commentaire', $this->date_comment);

        try {
            $pdo->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getCommentsByVisite($id_visite)
    {
        $pdo = new Database();
        $sql = "SELECT c.*, u.nom FROM commentaire c JOIN utilisateur u ON c.id_user = u.id_user WHERE c.id_visite = :id_visite ORDER BY c.date_commentaire DESC";
        $pdo->query($sql);
        $pdo->bind(':id_visite', $id_visite);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            return $pdo->get();
        } else {
            return null;
        }
    }

    public function getAllComments()
    {
        $pdo = new Database();
        $sql = "SELECT c.*, u.nom as user_name, v.titre as visite_titre FROM commentaire c JOIN utilisateur u ON c.id_user = u.id_user JOIN visitesguidees v ON c.id_visite = v.id_visite ORDER BY c.date_commentaire DESC";
        $pdo->query($sql);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            return $pdo->get();
        } else {
            return null;
        }
    }

    public function deleteComment($id_comment)
    {
        $pdo = new Database();
        $sql = "DELETE FROM commentaire WHERE id_comment = :id_comment";
        $pdo->query($sql);
        $pdo->bind(':id_comment', $id_comment);
        try {
            $pdo->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAverageRating($id_visite)
    {
        $pdo = new Database();
        $sql = "SELECT AVG(note) as avg_rating FROM commentaire WHERE id_visite = :id_visite";
        $pdo->query($sql);
        $pdo->bind(':id_visite', $id_visite);
        $pdo->execute();
        $result = $pdo->single();
        return $result ? $result->avg_rating : 0;
    }

    public function updateComment($id_comment, $text, $note)
    {
        $pdo = new Database();
        $sql = "UPDATE commentaire SET texte = :texte, note = :note WHERE id_comment = :id_comment";
        $pdo->query($sql);
        $pdo->bind(':texte', $text);
        $pdo->bind(':note', $note);
        $pdo->bind(':id_comment', $id_comment);
        try {
            $pdo->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function hasUserCommented($id_user, $id_visite)
    {
        $pdo = new Database();
        $sql = "SELECT COUNT(*) as count FROM commentaire WHERE id_user = :idu AND id_visite = :idv";
        $pdo->query($sql);
        $pdo->bind(':idu', $id_user);
        $pdo->bind(':idv', $id_visite);
        $pdo->execute();
        $result = $pdo->single();
        return $result && $result->count > 0;
    }

    public function getCommentsByGuide($id_guide)
    {
        $pdo = new Database();
        $sql = "SELECT c.*, u.nom as reviewer_nom 
                FROM commentaire c 
                JOIN visitesguidees v ON c.id_visite = v.id_visite 
                JOIN utilisateur u ON c.id_user = u.id_user 
                WHERE v.id_user = :id_guide 
                ORDER BY c.date_commentaire DESC";
        $pdo->query($sql);
        $pdo->bind(':id_guide', $id_guide);
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            return $pdo->get();
        } else {
            return null;
        }
    }
}
