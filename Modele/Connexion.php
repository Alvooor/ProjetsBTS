<?php

class Connexion{
    
    //
    
    public static function getUtilisateurByID($id) 
    {
        $resultat = array();

        try 
        {
            $cnx = connexionPDO();
            $req = $cnx->prepare("select * from utilisateurs where id=:id");
            $req->bindValue(':id', $id, PDO::PARAM_STR);
            $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }
}

