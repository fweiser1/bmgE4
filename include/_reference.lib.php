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
    public function setCode($p_code) {
        $this->_code = $p_code;
    }

    public function setLibelle($p_libelle) {
        $this->_libelle = $p_libelle;
    }

}
/*
 *  ====================================================================
 *  Classe Auteur : représente un auteur 
 *  ====================================================================
*/

class Auteur {
    private $_id;
    private $_nom;
    private $_prenom;
    private $_alias;
    private $_notes;

   
    

    /**
     * Constructeur 
    */				
    public function __construct(
            $a_id = null,
            $a_nom = null,
            $a_prenom = "",
            $a_alias = "",
            $a_notes = ""
    ) {
       $this->setId($a_id);
        $this->setNom($a_nom);
        $this->setPrenom($a_prenom);
        $this->setAlias($a_alias);
        $this->setNotes($a_notes);
    }  
    
    /**
     * Accesseurs
    */
    public function getId() {
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
    
    /**
     * Mutateurs
    */   
    public function setId($a_id) {
        $this->_id = $a_id;
    }

    public function setNom($a_nom) {
        $this->_nom = $a_nom;
    }

    public function setPrenom($a_prenom) {
        $this->_prenom = $a_prenom;
    }
    
    public function setAlias($a_alias) {
        $this->_alias = $a_alias;
    }
    
    public function setNotes($a_notes) {
        $this->_notes = $a_notes;
    }

}

/*
 *  ====================================================================
 *  Classe Ouvrage : représente un ouvrage 
 *  ====================================================================
*/

class Ouvrage {
    private $_noOuvrage;
    private $_titre;
    private $_salle;
    private $_rayon;
    private $_leGenre;
    private $_dateAcquisition;
    private $_lesAuteurs;
    private $_dernierPret;
    private $_disponibilite;
    private $_listeNomsAuteurs;
    

   
    

    /**
     * Constructeur 
    */				
    public function __construct(
            $p_noOuvrage,
            $p_titre,
            $p_salle,
            $p_rayon,
            $p_leGenre,
            $p_acquisition = null
            
    ) {
        $this->setNoOuvrage($p_noOuvrage);
        $this->setTitre($p_titre);
        $this->setSalle($p_salle);
        $this->setRayon($p_rayon);
        $this->setLeGenre($p_leGenre);
        $this->setDateAcquisition($p_acquisition);
        $this->_lesAuteurs = array();
    }  
    
    /**
     * Accesseurs
    */
    public function getNoOuvrage() {
        return $this->_noOuvrage;
    }

    public function getTitre() {
        return $this->_titre;
    }
    
     public function getSalle() {
        return $this->_salle;
    }
    
     public function getRayon() {
        return $this->_rayon;
    }
    
     public function getLeGenre() {
        return $this->_leGenre;  
    }
    
     public function getDateAcquisition() {
        return $this->_dateAcquisition;
    }
    
    
    public function getDernierPret() {
        return $this->_dernierPret;
    }
    
    public function getDisponibilite() {
        return $this->_disponibilite;
    }
    
    public function getListeNomsAuteurs() {
        return $this->_listeNomsAuteurs;
    }
    
    /**
     * Mutateurs
    */   
    public function setNoOuvrage($a_num) {
        $this->_noOuvrage = $a_num;
    }

    public function setTitre($a_titre) {
        $this->_titre = $a_titre;
    }

    public function setSalle($a_salle) {
        $this->_salle = $a_salle;
    }
    
    public function setRayon($a_rayon) {
        $this->_rayon = $a_rayon;
    }
    
    public function setLeGenre($a_leGenre) {
        $this->_leGenre = $a_leGenre;
    }
    
    public function setDateAcquisition($a_acquisition) {
        $this->_dateAcquisition = $a_acquisition;
    }
    
    public function setDernierPret($a_dernierPret) {
        $this->_dernierPret = $a_dernierPret;
    }
    
    public function setDisponibilite($a_disponibilite) {
        $this->_disponibilite = $a_disponibilite;
    }
    
    public function setListeNomsAuteurs($a_listeNomsAuteurs) {
        $this->_listeNomsAuteurs = $a_listeNomsAuteurs;
    }
    
}

class Client {
    private $_id;
    private $_nom;
    private $_prenom;
    private $_rue;
    private $_codePost;
    private $_ville;
    private $_dateInscr;
    private $_mel;
    private $_etat;

   
    

    /**
     * Constructeur 
    */				
    public function __construct(
            $a_id = null,
            $a_nom = "",
            $a_prenom = "",
            $a_rue = "",
            $a_codePost = "",
            $a_ville = "",
            $a_dateInscr = "",
            $a_mel = "",
            $a_etat = ""
    ) {
       $this->setId($a_id);
        $this->setNom($a_nom);
        $this->setPrenom($a_prenom);
        $this->setRue($a_rue);
        $this->setCodePost($a_codePost);
        $this->setVille($a_ville);
        $this->setDateInscr($a_dateInscr);
        $this->setMel($a_mel);
        $this->setEtat($a_etat);
    }  
    
    /**
     * Accesseurs
    */
    public function getId() {
        return $this->_id;
    }

    public function getNom() {
        return $this->_nom;
    }
    
     public function getPrenom() {
        return $this->_prenom;
    }
    
     public function getRue() {
        return $this->_rue;
    }
    
     public function getCodePost() {
        return $this->_codePost;
    }
    
    public function getVille() {
        return $this->_ville;
    }
    
    public function getDateInscr() {
        return $this->_dateInscr;
    }
    
    public function getMel() {
        return $this->_mel;
    }
    
    public function getEtat() {
        return $this->_etat;
    }
    
    /**
     * Mutateurs
    */   
    public function setId($a_id) {
        $this->_id = $a_id;
    }

    public function setNom($a_nom) {
        $this->_nom = $a_nom;
    }

    public function setPrenom($a_prenom) {
        $this->_prenom = $a_prenom;
    }
    
    public function setRue($a_rue) {
        $this->_rue = $a_rue;
    }
    
    public function setCodePost($a_codePost) {
        $this->_codePost = $a_codePost;
    }
    
    public function setVille($a_ville) {
        $this->_ville = $a_ville;
    }
    
    public function setDateInscr($a_codeInscr) {
        $this->_codeInscr = $a_codeInscr;
    }
    
    public function setMel($a_mel) {
        $this->_mel = $a_mel;
    }
    
    public function setEtat($a_etat) {
        $this->_etat = $a_etat;
    }

}

