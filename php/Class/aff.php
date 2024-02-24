<?php

// Inclusion du fichier de la classe database
include_once(__DIR__ . '/../BDD/database.php');

class Aff
{
    // propriété privée contenant le nom de la table pour pouvoir y accéder dans les fonctions
    private $table_name = 'aff';

    // Méthode permettant d'ajouter un nouvel élément dans la table aff
    public function addAff($np, $nc, $annee)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour insérer un nouvel élément dans aff
        $sql = "INSERT INTO ". $this->table_name ."(NP, NC, ANNEE) VALUES(:np, :nc, :annee)";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liage des params
        $stmt->bindParam(':np', $np);
        $stmt->bindParam(':nc', $nc);
        $stmt->bindParam(':annee', $annee);

        // Exécution de la requête
        if($stmt->execute())
        {
            return "Element ajouté avec succès";
        }
        else
        {
            return "Une erreur est survenue lors de l'ajout";
        }
    }

    // Méthode pour récupérer tous les éléments dans aff
    public function getAff()
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour get tous les éléments dans aff
        $sql = "SELECT * FROM ". $this->table_name;

        try
        {
            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Exécution de la requête
            $stmt->execute();

            // Récupération des données
            $affs = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $affs;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de l'opération";
        }
    }

    // Méthode qui récupère un élément de aff en fonction de np
    public function getAffById($np, $nc, $annee)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // requête pour récupérer une élement dans aff en fonction de np
        $sql = "SELECT * FROM ". $this->table_name ." WHERE NP = :np AND NC = :nc AND ANNEE = :annee ";

        try
        {
            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Liage des params
            $stmt->bindParam(':np', $np);
            $stmt->bindParam(':nc', $nc);
            $stmt->bindParam(':annee', $annee);

            // Exécution de la requête
            $stmt->execute();

            // récupération des données
            $aff = $stmt->fetch(PDO::FETCH_ASSOC);

            return $aff;
        }
        catch (PDOException $e)
        {
            return $e;
        }
    }

    // Partie C
    //Méthode pour Lister les noms et prénoms des chercheurs qui ont participé à plus de 2 projets durant une
    //année et dont le budget du projet est supérieur à 30k euros.
    public function getChercheurByAnnee()
    {
        // Connexion à la BDD
        $database = new Database();
        $conn= $database->getConnection();

        // Requête Sql
        $sql = "SELECT c.NOM, c.PRENOM FROM chercheur c 
                JOIN aff a ON c.NC = a.NC   
                JOIN projet p ON a.NP = p.NP
                WHERE a.ANNEE IN (SELECT DISTINCT ANNEE FROM aff)
                GROUP BY c.NC, a.ANNEE
                HAVING COUNT(DISTINCT a.NP) > 2 AND SUM(p.BUDGET) > 30000";

        try
        {
            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Exécution
            $stmt->execute();

            // On récupère les données
            $chercheur = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $chercheur;

        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de loperation";
        }
    }

    //Partie C
    // Méthode pour lister les chercheurs qui ont participé au même projet que « M. VIEIRA » en 2018.
    public function getChercheurAsVieira()
    {
        // Connexion BDD
        $database = new Database();
        $conn = $database->getConnection();

        // SQL
        $sql = "SELECT c.NOM, c.PRENOM FROM chercheur c
                JOIN aff a ON c.NC = a.NC
                JOIN projet p ON a.NP = p.NP
                JOIN chercheur cv ON cv.NC = a.NC
                WHERE cv.NOM = 'VIEIRA' AND YEAR(a.ANNEE) = 2018";

        try
        {
            // Préparation requête
            $stmt = $conn->prepare($sql);

            // Exécution
            $stmt->execute();

            // récupération résultats
           $chercheur= $stmt->fetchAll(PDO::FETCH_ASSOC);

           return $chercheur;

        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de la recuperation des chercheurs";
        }

    }

    // Méthode de mise à jour d'un élement dans aff en fonction de np
    public function updateAff($np, $nc, $annee)
    {
        // Connextion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête de mise à jour
        $sql = "UPDATE ". $this->table_name ." SET NC = :nc, ANNEE = :annee WHERE NP = :np";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liage des params
        $stmt->bindParam(':np', $np);
        $stmt->bindParam(':nc', $nc);
        $stmt->bindParam(':annee', $annee);

        // Exécution de la requête
        if($stmt->execute())
        {
            return "Elément mis à jour avec succès";
        }
        else
        {
            return "Une erreur est survenue lors de la mise à jour";
        }
    }

    // Méthode permettant de supprimer un élément dans aff en fonction de np
    public function deleteAff($np, $nc, $annee)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête de suppréssion
        $sql = "DELETE FROM ". $this->table_name ." WHERE NP = :np AND NC = :nc AND ANNEE = :annee";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liage params
        $stmt->bindParam(':np', $np);
        $stmt->bindParam(':nc', $nc);
        $stmt->bindParam(':annee', $annee);

        // Exécution de la requête
        if($stmt->execute())
        {
            return "Suppression reussie";
        }
        else
        {
            return "Une erreur est survenue lors de la suppression";
        }
    }
}