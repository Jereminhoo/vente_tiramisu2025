<?php

class UtilisateurDAO
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getUtilisateur($nom, $mdp)
    {
        $query = "SELECT get_utilisateur(:nom, :mdp) AS nom";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindValue(':nom', $nom);
            $resultset->bindValue(':mdp', $mdp);
            $resultset->execute();
            $nom = $resultset->fetchColumn(0);
            $this->_bd->commit();
            return $nom;
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }

    public function ajoutUtilisateur($nom, $mdp)
    {
        $query = "SELECT ajout_utilisateur(:nom, :mdp) AS message";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':mdp', $mdp, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['message'];
        } catch (PDOException $e) {
            echo "Erreur d'ajout : " . $e->getMessage();
            return -1;
        }
    }

    public function supprimerUtilisateur($nom)
    {
        $query = "SELECT supprimer_utilisateur(:nom) AS message";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['message'];
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return -1;
        }
    }

    public function getAllUtilisateurs()
{
    $query = "SELECT * FROM utilisateurs";
    try {
        $stmt = $this->_bd->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Erreur lors de la récupération : " . $e->getMessage();
        return [];
    }
}

} 