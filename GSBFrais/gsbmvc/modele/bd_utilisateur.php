<?php

class bd_utilisateur{
    
    public static function seConnecter($login, $mdp) 
    {
        if (empty($login) || empty($mdp))
        {
            return;
        }
        if (!isset($_SESSION)) 
        {
            session_start();
        }

        //self remplace le nom de la classe de la méthode appelée
        $util = self::getUtilisateurByLogin($login);
        $mdpBD = $util["mdp"];

        if (trim($mdpBD) == trim($mdp))
        {
            $visiteur=new m_utilisateur($util["id"], $util["nom"], $util["prenom"], $login, $mdpBD, $util["typeUtilisateur"]);
            $_SESSION["visiteur"] = $visiteur;
        }
    }
    
    public static function getUtilisateurByLogin($login){
        try 
        {
            $cnx = bdd_access::getMonPDO();
            $req = $cnx -> prepare("select * from visiteur where login=:login");
            $req -> bindValue(':login', $login, PDO::PARAM_STR);
            $req -> execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        } 
        catch (PDOException $e) 
        {
            print "Erreur !: " . $e->getMessage();
            die();
        }
        return $resultat;
    }

    public static function getInfosVisiteur($login, $mdp){
		$req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom from visiteur 
		where visiteur.login='$login' and visiteur.mdp='$mdp'";
		$rs = bdd_access::getMonPDO()->query($req);
		$ligne = $rs->fetch();
		return $ligne;
    }

    public static function getLesVisiteurs(){
        $req = "select * from visiteur
        where typeUtilisateur = 'visiteur'";
        $rs = bdd_access::getMonPDO()->query($req);
        $ligne = $rs->fetchALL();
		return $ligne;
    }
    
    public static function ajouterErreur($msg){
        if (! isset($_REQUEST['erreurs'])){
            $_REQUEST['erreurs']=array();
        } 
        $_REQUEST['erreurs'][]=$msg;
    }
}

