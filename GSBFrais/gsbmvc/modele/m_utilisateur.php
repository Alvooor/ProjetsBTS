<?php

class m_utilisateur{
    
    private $id;
    private $nom;
    private $prenom;
    private $login;
    private $mdp;
    private $typeUtilisateur;
    
    public function __construct($unId, $unNom, $unPrenom, $unLogin, $unMDP, $unTypeUtilisateur){
        $this -> id = $unId;
        $this -> nom = $unNom;
        $this -> prenom = $unPrenom;
        $this -> login = $unLogin;
        $this -> mdp = $unMDP;
        $this -> typeUtilisateur = $unTypeUtilisateur;
    }
    
    public function getId(){
        return $this -> id;
    }
    
    public function getNom(){
        return $this -> nom;
    }
    
    public function getPrenom(){
        return $this -> prenom;
    }
    
    public function getRole(){
        return $this -> role;
    }
    
    public function getTypeUtilisateur(){
        return $this -> typeUtilisateur;
    }
    
    public function setId($id){
        $this -> id = $id;
    }
    
    public function setNom($nom){
        $this -> nom = $nom;
    }
    
    public function setPrenom($prenom){
        $this -> prenom = $prenom;
    }

    public function setRole($role){
        $this -> role = $role;
    }
}
