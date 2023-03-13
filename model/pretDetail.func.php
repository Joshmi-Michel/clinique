<?php 
    
    function getNbPret($numLecteur)
    {
        global $db;
        $numLecteur = htmlspecialchars(trim(intval($numLecteur)));
        $sql = "SELECT
                COUNT(numPret) as nbPret       
                FROM pret
                WHERE pret.numLecteur = ?
                AND rendu = 0
        ";
        $req = $db->prepare($sql);
        $req->execute([$numLecteur]);

        $results = [];

        while ($rows = $req->fetchObject()) {
          $results[] = $rows;
        }
        return $results;
    }

    function getPretDetail($numLecteur)
    {
        global $db;
        $numLecteur = htmlspecialchars(trim(intval($numLecteur)));
        $sql = "SELECT
            pret.numPret,
            pret.numLecteur,
            pret.numLivre,
            pret.datePret,
            lecteur.numLecteur,
            lecteur.nomLecteur,
            livre.numLivre,
            livre.titre,
            livre.auteur,
            livre.dateEdition       
            FROM pret,lecteur,livre
            WHERE pret.numLecteur = lecteur.numLecteur
            AND pret.numLivre = livre.numLivre
            AND pret.rendu = 0
            AND pret.numLecteur = ?
        ";
        $req = $db->prepare($sql);
        $req->execute([$numLecteur]);

        $results = [];

        while ($rows = $req->fetchObject()) {
          $results[] = $rows;
        }
        return $results;
    }

?>