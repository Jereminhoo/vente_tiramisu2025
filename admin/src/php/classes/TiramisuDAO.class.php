<?php
class TiramisuDAO
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }
    public function getTiramisus()
    {
        $query = "select * from tiramisus";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->execute();
            $data = $resultset->fetchAll();
            foreach ($data as $d) {
                $_array[] = new Tiramisus($d);
            }
            if(!empty($_array)){
                return $_array;
            } else {
                return null;
            }
            $this->_bd->commit();
        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }

    public function getAllTiramisus()
    {
        $query = "SELECT * FROM tiramisus";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des tiramisus : " . $e->getMessage();
            return [];
        }
    }

    public function ajoutTiramisu($nom_tiramisu, $description, $prix, $photo)
    {
        $query = "SELECT ajout_tiramisu(:nom_tiramisu, :description, :prix, :photo) AS message";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom_tiramisu', $nom_tiramisu, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['message'];
        } catch (PDOException $e) {
            echo "Erreur d'ajout : " . $e->getMessage();
            return -1;
        }
    }

    public function supprimerTiramisu($nom_tiramisu)
    {
        $query = "SELECT supprimer_tiramisu(:nom_tiramisu) AS message";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom_tiramisu', $nom_tiramisu, PDO::PARAM_STR);
            $stmt->execute();
            $res = $stmt->fetch(PDO::FETCH_ASSOC);
            return $res['message'];
        } catch (PDOException $e) {
            echo "Erreur lors de la suppression : " . $e->getMessage();
            return "Erreur interne";
        }
    }




}
