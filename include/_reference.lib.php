<?php 
/** 
 * 
 * BMG
 * © GroSoft
 * 
 * References
 * Classes métier
 *
 *
 * @package 	default
 * @author 	dk
 * @version    	1.0
 */

/*
 *  ====================================================================
 *  Classe Genre : représente un genre d'ouvrage 
 *  ====================================================================
*/

class Genre {
    private $_code;
    private $_libelle;

    /**
     * Constructeur 
    */				
    public function __construct(
            $p_code,
            $p_libelle
    ) {
        $this->setCode($p_code);
        $this->setLibelle($p_libelle);
    }  
    
    /**
     * Accesseurs
    */
    public function getCode() {
        return $this->_code;
    }

    public function getLibelle() {
        return $this->_libelle;
    }
    
    /**
     * Mutateurs
    */   
    public function setCode ($p_code) {
        $this->_code = $p_code;
    }

    public function setLibelle ($p_libelle) {
        $this->_libelle = $p_libelle;
    }

}

/*
 *  ====================================================================
 *  Classe Auteur : représente un auteur d'ouvrage 
 *  ====================================================================
*/

class Auteur {
    private $_id;
    private $_nom;
    private $_prenom;
    private $_alias;
    private $_notes;
    
    public function __construct(
            $p_id,
            $p_nom,
            $p_prenom,
            $p_alias,
            $p_notes
    ) {
        $this->setID($p_id);
        $this->setNom($p_code);
        $this->setPrenom($p_libelle);
        $this->setAlias($p_libelle);
        $this->setNotes($p_libelle);
    }  
    
    public function getID() {
        return $this->_id;
    }
    
    public function getNom() {
        return $this->_nom;
    }
    
    public function getPrenom() {
        return $this->_prenom;
    }
    
    public function getAlias() {
        return $this->_alias;
    }
    
    public function getNotes() {
        return $this->_notes;
    }
}


