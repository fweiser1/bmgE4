<?php

require_once('PdoDao.class.php');

class OuvrageDal {

    public static function loadOuvrages($style) {
        $cnx = new PdoDao();
        $qry = 'SELECT * FROM ouvrage';
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if ($style == 1) {
            $res = array();
            foreach ($tab as $ligne) {
                $unOuvrage = new Ouvrage($ligne->no_ouvrage, $ligne->titre, $ligne->salle, $ligne->rayon, $ligne->code_genre, $ligne->lib_genre, $ligne->acquisition, $ligne->auteur, $ligne->dernier_pret, $ligne->disponibilite);
                array_push($res, $unOuvrage);
            }
            return $res;
        }
        return $tab;
    }

    public static function loadOuvrageByID($id) {
        $cnx = new PdoDao();
        // requête
        $qry = 'SELECT no_ouvrage, titre, salle, rayon, code_genre,lib_genre, acquisition, auteur, dernier_pret, disponibilite FROM v_ouvrages WHERE no_ouvrage = ?';
        $res = $cnx->getRows($qry, array($id), 1);
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if (!empty($res)) {
            // le genre existe
            $no_ouvrage = $res[0]->no_ouvrage;
            $titre = $res[0]->titre;
            $salle = $res[0]->salle;
            $rayon= $res[0]->rayon;
            $code_genre = $res[0]->code_genre;
            $lib_genre = $res[0]->lib_genre;
            $acquisition = $res[0]->acquisition;
            $auteur = $res[0]->auteur;
            $dernier_pret = $res[0]->dernier_pret;
            $disponibilite = $res[0]->disponibilite;
            return new Ouvrage($no_ouvrage, $titre, $salle, $rayon, $code_genre, $lib_genre, $acquisition ,$auteur, $dernier_pret, $disponibilite);
        } else {
            return NULL;
        }
    }

    public static function addOuvrage($titre, $salle, $rayon, $code_genre, $acquisition) {
        $cnx = new PdoDao();
        $qry = 'INSERT INTO ouvrage ($titre, $salle, $rayon, $code_genre, $date_acquisition) VALUES (?,?,?,?,?)';
        $res = $cnx->execSQL($qry, array(// nb de lignes affectées
            $titre,
            $salle,
            $rayon,
            $code_genre,
            $date_acquisition
                )
                
        );
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }
    
    public static function countOuvrages($id) {
        $cnx = new PdoDao();
        $qry = 'SELECT COUNT(*) FROM ouvrage WHERE no_ouvrage = ?';
        $res = $cnx->getValue($qry, array($id));
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }
    
    public static function delOuvrage($id) {
        $cnx = new PdoDao();
        $qry = 'DELETE FROM ouvrage WHERE no_ouvrage = ?';
        $res = $cnx->execSQL($qry, array($id));
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
       
    }
    
    public static function setOuvrage($unOuvrage) {
        $cnx = new PdoDao();
        $qry = 'UPDATE ouvrage SET titre = ? , salle = ?, rayon = ?, code_genre = ?, date_acquisition = ?';
        $res = $cnx->execSQL($qry, array($unOuvrage->getTitre(),$unOuvrage->getSalle(),$unOuvrage->getRayon(),$unOuvrage->getCodeGenre(),$unOuvrage->getDateAcquisition()));
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        
        return $res;
    }
}

?>