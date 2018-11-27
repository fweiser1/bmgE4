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
    private $_id_auteur;
    private $_nom_auteur;
    private $_prenom_auteur;
    private $_alias;
    private $_notes;
    
    public function __construct(
            $p_id_auteur,
            $p_nom_auteur,
            $p_prenom_auteur,
            $p_alias,
            $p_notes
    ) {
        $this->setId($p_id_auteur);
        $this->setNom($p_nom_auteur);
        $this->setPrenom($p_prenom_auteur);
        $this->setAlias($p_alias);
        $this->setNotes($p_notes);
    }  
    
    public function getId() {
        return $this->_id_auteur;
    }
    
    public function getNom() {
        return $this->_nom_auteur;
    }
    
    public function getPrenom() {
        return $this->_prenom_auteur;
    }
    
    public function getAlias() {
        return $this->_alias;
    }
    
    public function getNotes() {
        return $this->_notes;
    }
    
    public function setId($p_id_auteur) {
        $this->_id_auteur = $p_id_auteur;
    }
    
    public function setNom($p_nom_auteur) {
        $this->_nom_auteur = $p_nom_auteur;
    }
    
    public function setPrenom($p_prenom_auteur) {
        $this->_prenom_auteur = $p_prenom_auteur;
    }
    
    public function setAlias($p_alias) {
        $this->_alias = $p_alias;
    }
    
    public function setNotes($p_notes) {
        $this->_notes = $p_notes;
    }
}


