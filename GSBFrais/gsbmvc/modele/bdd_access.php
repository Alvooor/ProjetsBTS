<?php

class bdd_access{
    
    private static $serveur='mysql:host=localhost';
    private static $bdd='dbname=gsbfrais';   		
    private static $user='root' ;    		
    private static $mdp='' ;	
    private static $monPdo;
    private static $monPdoGsb=null;


//le __construct permet de créer l'accès à la base de donnée qui est rangé dans la variable $monPdo//

    private function __construct(){
    	bdd_access::$monPdo = new PDO(bdd_access::$serveur.';'.bdd_access::$bdd, bdd_access::$user, bdd_access::$mdp); 
		bdd_access::$monPdo->query("SET CHARACTER SET utf8");
	}
        
	public function _destruct(){
		bdd_access::$monPdo = null;
	}
        
        public  static function getPdoGsb(){
		if(bdd_access::$monPdoGsb==null){
			bdd_access::$monPdoGsb= new bdd_access();
		}
		return bdd_access::$monPdoGsb;  
	}
        
        public static function getMonPDO(){
            return bdd_access::$monPdo;
        }
}
