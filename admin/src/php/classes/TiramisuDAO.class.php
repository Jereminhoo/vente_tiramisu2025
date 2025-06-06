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
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Erreur de récupération : " . $e->getMessage();
            return [];
        }
    }


    public function ajoutTiramisu($nom, $description, $prix, $photo)
    {
        $query = "INSERT INTO tiramisus (nom_tiramisu, description, prix, photo)
              VALUES (:nom_tiramisu, :description, :prix, :photo)";

        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':nom_tiramisu', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->execute();

            return $this->_bd->lastInsertId();
        } catch (PDOException $e) {
            echo "<div > Erreur SQL : " . $e->getMessage() . "</div>";
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

    public function getTiramisuById($id)
    {
        $query = "SELECT * FROM tiramisus WHERE id_tiramisu = :id_tiramisu";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_tiramisu', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération : " . $e->getMessage();
            return null;
        }
    }


    public function modifierTiramisu($id, $nom, $description, $prix, $photo)
    {
        $query = "UPDATE tiramisus 
              SET nom_tiramisu = :nom, description = :description, prix = :prix, photo = :photo 
              WHERE id_tiramisu = :id_tiramisu";
        try {
            $stmt = $this->_bd->prepare($query);
            $stmt->bindValue(':id_tiramisu', $id, PDO::PARAM_INT);
            $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
            $stmt->bindValue(':description', $description, PDO::PARAM_STR);
            $stmt->bindValue(':prix', $prix, PDO::PARAM_STR);
            $stmt->bindValue(':photo', $photo, PDO::PARAM_STR);
            $stmt->execute();
            return "Tiramisu modifié";
        } catch (PDOException $e) {
            echo "Erreur de modification : " . $e->getMessage();
            return "Erreur lors de la modification";
        }
    }







}
