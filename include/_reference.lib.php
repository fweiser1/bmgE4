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

class Ouvrage {
    private $_no_ouvrage;
    private $_titre_ouvrage;
    private $_salle_ouvrage;
    private $_rayon_ouvrage;
    private $_code_genre_ouvrage;
    private $_date_acquisition_ouvrage;
    
    public function __construct(
            $p_no_ouvrage,
            $p_titre_ouvrage,
            $p_salle_ouvrage,
            $p_rayon_ouvrage,
            $p_code_genre_ouvrage,
            $p_date_acquisition_ouvrage
    ) {
        $this->setNo($p_no_ouvrage);
        $this->setTitre($p_titre_ouvrage);
        $this->setSalle($p_salle_ouvrage);
        $this->setRayon($p_rayon_ouvrage);
        $this->setCodeGenre($p_code_genre_ouvrage);
        $this->setDateAcquisition($p_date_acquisition_ouvrage);
    }  
    
    public function getNo() {
        return $this->_no_ouvrage;
    }
    
    public function getTitre() {
        return $this->_titre_ouvrage;
    }
    
    public function getSalle() {
        return $this->_salle_ouvrage;
    }
    
    public function getRayon() {
        return $this->_rayon_ouvrage;
    }
    public function getCodeGenre() {
        return $this->_code_genre_ouvrage;
    }
    
    public function getDateAcquisition() {
        return $this->_date_acquisition_ouvrage;
    }
    
    public function setNo($p_no_ouvrage) {
        $this->_no_ouvrage = $p_no_ouvrage;
    }
    
    public function setTitre($p_titre_ouvrage) {
        $this->_titre_ouvrage = $p_titre_ouvrage;
    }
    
    public function setSalle($p_salle_ouvrage) {
        $this->_salle_ouvrage = $p_salle_ouvrage;
    }
    
    public function setRayon($p_rayon_ouvrage) {
        $this->_rayon_ouvrage = $p_rayon_ouvrage;
    }
    public function setCodeGenre($p_code_genre_ouvrage) {
        $this->_code_genre_ouvrage = $p_code_genre_ouvrage;
    }
    
    public function setDateAcquisition($p_date_acquisition_ouvrage) {
        $this->_date_acquisition_ouvrage = $p_date_acquisition_ouvrage;
    }
}


