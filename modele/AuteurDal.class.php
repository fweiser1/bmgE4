<?php

require_once('PdoDao.class.php');

class AuteurDal {

    public static function loadAuteurs($style) {
        $cnx = new PdoDao();
        $qry = 'SELECT * FROM auteur';
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if ($style == 1) {
            $res = array();
            foreach ($tab as $ligne) {
                $unAuteur = new Auteur($ligne->id_auteur, $ligne->nom_auteur, $ligne->prenom_auteur, $ligne->alias, $ligne->notes);
                array_push($res, $unAuteur);
            }
            return $res;
        }
        return $tab;
    }

    public static function loadAuteurByID($id) {
        $cnx = new PdoDao();
        // requête
        $qry = 'SELECT id_auteur, nom_auteur, prenom_auteur, alias, notes FROM auteur WHERE id_auteur = ?';
        $res = $cnx->getRows($qry, array($id), 1);
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        if (!empty($res)) {
            // le genre existe
            $id_auteur = $res[0]->id_auteur;
            $nom = $res[0]->nom_auteur;
            $prenom = $res[0]->prenom_auteur;
            $alias = $res[0]->alias;
            $notes = $res[0]->notes;
            return new Auteur($id_auteur, $nom, $prenom, $alias, $notes);
        } else {
            return NULL;
        }
    }

    public static function addAuteur($nom, $prenom, $alias, $notes) {
        $cnx = new PdoDao();
        $qry = 'INSERT INTO auteur (nom_auteur, prenom_auteur, alias, notes) VALUES (?,?,?,?)';
        $res = $cnx->execSQL($qry, array(// nb de lignes affectées
            $nom,
            $prenom,
            $alias,
            $notes
                )
                
        );
        if (is_a($res, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        return $res;
    }
    
    public static function idMax()
    {
        $cnx = new PdoDao();
        $qry = 'Select Max(id_auteur)+1 from auteur';
        $tab = $cnx->getRows($qry, array(), $style);
    }
}

?>