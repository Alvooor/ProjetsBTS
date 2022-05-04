<?php

class bd_fichedefrais{
    
    public static function getFichedeFraisByIDvisiteur($idVisiteur){
        try 
        {
            $cnx = bdd_access::getMonPDO();
            $req = $cnx -> prepare("select * from fichefrais where idVisiteur=:idVisiteur");
            $req -> bindValue(':idVisiteur', $idVisiteur, PDO::PARAM_STR);
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
    
    public static function ajouterErreur($msg){
        if (! isset($_REQUEST['erreurs'])){
            $_REQUEST['erreurs']=array();
        } 
        $_REQUEST['erreurs'][]=$msg;
    }
    
    public static function estPremierFraisMois($idVisiteur,$mois){
		$ok = false;
		$req = "select count(*) as nblignesfrais from fichefrais 
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
		$res = bdd_access::getMonPDO()->query($req);
		$laLigne = $res->fetch();
		if($laLigne['nblignesfrais'] == 0){
			$ok = true;
		}
		return $ok;
	}

    public static function getLesMoisDisponibles($idVisiteur){
		$req = "select fichefrais.mois as mois from  fichefrais where fichefrais.idvisiteur ='$idVisiteur' 
		order by fichefrais.mois desc ";
		$res = bdd_access::getMonPDO()->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		while($laLigne != null)	{
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}

    public static function getLesInfosFicheFrais($idVisiteur,$mois){
		$req = "select ficheFrais.idEtat as idEtat, ficheFrais.dateModif as dateModif, ficheFrais.nbJustificatifs as nbJustificatifs, 
			ficheFrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join Etat on ficheFrais.idEtat = Etat.id 
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		$res = bdd_access::getMonPDO()->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	}

    public static function majEtatFicheFrais($idVisiteur,$mois,$etat){
		$req = "update ficheFrais set idEtat = '$etat', dateModif = now() 
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
		bdd_access::getMonPDO()->exec($req);
	}

	public static function getLesMois($date){
		$req = "select mois from fichefrais 
		where fichefrais.mois <'$date' 
		order by fichefrais.mois desc ";
		$res = bdd_access::getMonPDO()->query($req);
		$lesMois =array();
		$laLigne = $res->fetch();
		$i = 0;
		while($laLigne != null and $i < 6){
			$i++;
			$mois = $laLigne['mois'];
			$numAnnee =substr( $mois,0,4);
			$numMois =substr( $mois,4,2);
			$lesMois["$mois"]=array(
		     "mois"=>"$mois",
		    "numAnnee"  => "$numAnnee",
			"numMois"  => "$numMois"
             );
			$laLigne = $res->fetch(); 		
		}
		return $lesMois;
	}

	public static function getLesFraisForfait($idVisiteur, $mois){
		$req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, 
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait 
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois' 
		order by lignefraisforfait.idfraisforfait";	
		$res = bdd_access::getMonPDO()->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes; 
	}

	public static function getLesFraisHorsForfait($idVisiteur,$mois){
	    $req = "select * from lignefraishorsforfait where lignefraishorsforfait.idvisiteur ='$idVisiteur' 
		and lignefraishorsforfait.mois = '$mois' ";	
		$res = bdd_access::getMonPDO()->query($req);
		$lesLignes = $res->fetchAll();
		$nbLignes = count($lesLignes);
		for ($i=0; $i<$nbLignes; $i++){
			$date = $lesLignes[$i]['date'];
			$lesLignes[$i]['date'] =  dateAnglaisVersFrancais($date);
		}
		return $lesLignes; 
	}

	public static function majFraisForfait($idVisiteur, $mois, $lesFrais){
		$lesCles = array_keys($lesFrais);
		foreach($lesCles as $unIdFrais){
			$qte = $lesFrais[$unIdFrais];
			$req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
			bdd_access::getMonPDO()->exec($req);
		}		
	}

	public function supprimerFraisHorsForfait($idFrais){
		$req = "delete from lignefraishorsforfait where lignefraishorsforfait.id =$idFrais ";
		bdd_access::getMonPDO()->exec($req);
	}
}

