<?php

// sollicite les services de la classe PdoDao
require_once ('PdoDao.class.php');

class ClientDal {
    /**
     * charge un tableau de genres
     * @param  $style : 0 == tableau assoc, 1 == objet
     * @return  un objet de la classe PDOStatement
     */
    public static function loadClients($style) {
        // instanciation d'un objet PdoDao
        $cnx = new PdoDao(); 
        $qry = "SELECT no_client as ID, "
                ."nom_client as nom, "
                ."prenom, "
                ."rue_client as rue, "
                ."code_post as codePost, "
                ."ville, "
                ."date_inscr as dateInscr, "
                ."mel, "
                ."etat_client as etat "
                ."FROM client "
                ."ORDER BY nom_client;";
        $tab = $cnx->getRows($qry, array(), $style);
        if (is_a($tab, 'PDOException')) {
            return PDO_EXCEPTION_VALUE;
        }
        // dans le cas où on attend un tableau d'objets
        if ($style == 1) {
            // retourner un tableau d'objets
            $res = array();
            foreach ($tab as $ligne) {
                $unClient = new Client(
                        $ligne->ID, 
                        $ligne->nom,
                        $ligne->prenom,
                        $ligne->rue,
                        $ligne->codePost,
                        $ligne->ville,
                        $ligne->dateInscr,
                        $ligne->mel,
                        $ligne->etat
                );
                $unClient->setId($ligne->ID);
                $unClient->setNom($ligne->nom);
                $unClient->setPrenom($ligne->prenom);
                $unClient->setRue($ligne->rue);
                $unClient->setCodePost($ligne->codePost);
                $unClient->setVille($ligne->ville);
                $unClient->setDateInscr($ligne->dateInscr);
                $unClient->setMel($ligne->mel);
                $unClient->setEtat($ligne->etat);
                
                array_push($res, $unClient); // identique à $res[] = $unOuvrage;
            }
            return $res;
        }
        return $tab;
    }
}
