<?php
class Guide extends Utilisateur
{
    private $approved;

    public function __construct($nom = "", $email = "", $role = "", $MotPasseHash = "", $approved = "")
    {
        parent::__construct($nom, $email, $role, $MotPasseHash);
        $this->approved = $approved;
    }
    public function getAllGuides()
    {
        $pdo = new Database();
        $sql = 'SELECT * FROM utilisateur WHERE `role` = :rol AND isactive = :stat';
        $pdo->query($sql);
        $pdo->bind(':rol', 'guide');
        $pdo->bind(':stat', '0');
        $pdo->execute();
        if ($pdo->rowCount() > 0) {
            $guides = [];
            $guides = $pdo->get();
            return $guides;
        } else {
            return null;
        }
    }

    public function approve($id, $action)
    {

        $pdo = new Database();
        if ($action == 'approve') {
            $sql = 'SELECT * FROM utilisateur WHERE id_user = :idu';
            $pdo->query($sql);
            $pdo->bind(':idu', $id);
            $pdo->execute();
            if ($pdo->rowCount() == 1) {
                $result = $pdo->single();
                if ($result->role = 'guide' && $result->approved == 0) {
                    $sql = 'UPDATE utilisateur SET approved = 1 WHERE id_user = :idu';
                    $pdo->query($sql);
                    $pdo->bind(':idu', $id);
                    $pdo->execute();
                } else {
                    return null;
                }
            }
        } elseif ($action == 'reject') {
            $sql = 'SELECT * FROM utilisateur WHERE id_user = :idu';
            $pdo->query($sql);
            $pdo->bind(':idu', $id);
            $pdo->execute();
            if ($pdo->rowCount() == 1) {
                $result = $pdo->single();
                if ($result->role = 'guide' && $result->approved == 0) {
                    $sql = 'UPDATE utilisateur SET `role` = :reject WHERE id_user = :idu';
                    $pdo->query($sql);
                    $pdo->bind(':reject', 'NOTAPPROVED');
                    $pdo->bind(':idu', $id);
                    $pdo->execute();
                    return true;
                } else {
                    return null;
                }
            }
        }
    }
}
