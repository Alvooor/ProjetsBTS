<?php

class Utilisateur{
    
    private $nom;
    private $prenom;
    private $id;
    private $fav;
    
    public function __construct($cnom, $cprenom, $cid, $cfav){
        $this -> nom = $cnom;
        $this -> prenom = $cprenom;
        $this -> id = $cid;
        $this -> fav = $cfav;
    }
    
    public function getnom(){
        return $this -> nom;
    }
    
    public function getprenom(){
        return $this -> prenom;
    }
    
    public function getid(){
        return $this -> id;
    }
    
    public function getfav(){
        return $this -> fav;
    }
    
    public function setnom($nom)
    {
        $this->note=$nom;
    }
    
    public function setprenom($prenom)
    {
        $this->note=$prenom;
    }
    
    public function setid($id)
    {
        $this->note=$id;
    }
    
    public function setfav($fav)
    {
        $this->note=$fav;
    }
            
}
