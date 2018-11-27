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
                $unAuteur = new Auteur($ligne->id, $ligne->nom_auteur, $ligne->prenom_auteur, $ligne->alias, $ligne->notes);
                array_push($res, $unAuteur);
            }
            return $res;
        }
        return $tab;
    }
    
}

?>