<?php

class Zoo{
    
    private $nomduzoo;
    private $thematique;
    private $prixdubillet;
    private $ville;
    private $pays;
    private $horaires;
    
    public function __construct($cnomduzoo, $cthematique, $cprixdubillet, $cville, $cpays, $choraires){
        $this -> nomduzoo = $cnomduzoo;
        $this -> thematique = $cthematique;
        $this -> prixdubillet = $cprixdubillet;
        $this -> ville= $cville;
        $this -> pays = $cpays;
        $this -> horaires = $choraires;
    }
    
    public function getnomduzoo(){
        return $this -> nomduzoo;
    }
    
    public function getthematique(){
        return $this -> thematique;
    }
    
    public function getprixdubillet(){
        return $this -> prixdubillet;
    }
    
    public function getville(){
        return $this -> ville;
    }
    
    public function getpays(){
        return $this -> pays;
    }
    
    public function gethoraires(){
        return $this -> horaires;
    }
 
    public function setnomduzoo($nomduzoo)
    {
        $this -> nomduzoo = $nomduzoo;
    }
       
}

