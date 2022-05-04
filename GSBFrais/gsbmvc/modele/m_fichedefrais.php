<?php

class m_fichedefrais{
    
    private $idVisiteur;
    private $mois;
    private $nbJustificatifs;
    private $montantValide;
    private $dateModif;
    private $idEtat;
    
    public function __construct($unIdVisiteur, $unMois, $unNbJustificatifs, $unMontantValide, $uneDateModif, $unIdEtat){
        $this -> idVisiteur = $unIdVisiteur;
        $this -> mois = $unMois;
        $this -> nbJustificatifs = $unNbJustificatifs;
        $this -> montantValide = $unMontantValide;
        $this -> dateModif = $uneDateModif;
        $this -> idEtat = $unIdEtat;
    }
    
    public function getIdVisiteur(){
        return $this -> idVisiteur;
    }
    
    public function getMois(){
        return $this -> mois;
    }
    
    public function getNbJustificatifs(){
        return $this -> nbJustificatifs;
    }
    
    public function getMontantValide(){
        return $this -> montantValide;
    }
    
    public function getDateModif(){
        return $this -> dateModif;
    }
    
    public function getIdEtat(){
        return $this -> idEtat;
    }
    
    public function setIdVisiteur($idVisiteur){
        $this -> idVisiteur = $idVisiteur;
    }
    
    public function setMois($mois){
        $this -> mois = $mois;
    }
    
    public function setNbJustificatifs($nbJustificatifs){
        $this -> nbJustificatifs = $nbJustificatifs;
    }
    
    public function setMontantValide($montantValide){
        $this -> montantValide = $montantValide;
    }
    
    public function setDateModif($dateModif){
        $this -> dateModif = $dateModif;
    }
    
    public function setIdEtat($idEtat){
        $this -> idEtat = $idEtat;
    }
}