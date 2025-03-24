<?php
class AdminDAO
{
    private $_bd;
    private $_array = array();

    public function __construct($cnx)
    {
        $this->_bd = $cnx;
    }

    public function getAdmin($login , $password)
    {
        $query = "SELECT get_admin(:login, :password) AS nom";
        try {
            $this->_bd->beginTransaction();
            $resultset = $this->_bd->prepare($query);
            $resultset->bindvalue(':login', $login);
            $resultset->bindvalue(':password', $password);
            $resultset->execute();

            $nom = $resultset->fetchColumn(0);

            if(isset($nom)) return $nom;
            else return "ERREUR DE CONNEXION";

        } catch (PDOException $e) {
            $this->_bd->rollback();
            print "Echec de la requête " . $e->getMessage();
        }
    }
}