<?php

// Inclusion du fichier contenant la classe Database
include_once(__DIR__ . '/../BDD/database.php');

// Classe pour gérer les opérations CRUD sur la table "chercheur"
class Chercheur
{
    // propriété privée contenant le nom de la table pour pouvoir y accéder dans les fonctions
    private $table_name = 'chercheur';

    // Méthode pour créer un nouveau chercheur
    public function addChercheur($nc, $nom, $prenom, $ne)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour insérer un nouveau chercheur
        $sql = "Insert INTO ". $this->table_name ." (NC, NOM, PRENOM, NE) VALUES(:nc, :nom, :prenom, :ne)";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liages des paramètres
        $stmt->bindParam(':nc', $nc);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':ne', $ne);

        // exécution de la requête
        if($stmt->execute()){
            return "Chercheur ajouté avec succés";
        }
        else{
            return "Echec de l'ajout";
        }
    }

    public function getChercheur()
    {
        // Connexion à la bdd
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour récupérer tous les chercheurs de la table 'chercheur'
        $sql= "SELECT * FROM ". $this->table_name;

        try {
                // Préparation de la requête
                 $stmt= $conn->prepare($sql);

                // Exécution de la requête
                $stmt->execute();

                //Récupération des résultats
                $chercheurs= $stmt->fetchAll(PDO::FETCH_CLASS );

                return $chercheurs;
            }
            catch (PDOException $e)
            {
                // En cas d'erreur
                return "Une erreur est survenue";
            }
    }

    // Méthode pour récupérer la liste des chercheurs en
    // précisant pour chacun le nom de l’équipe à laquelle il appartient
    public function getChercheurAndNomEquipe()
    {
        // Connexion à la BDD
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL
         $sql = "SELECT chercheur.NC, chercheur.NOM AS NomChercheur, chercheur.PRENOM AS PrenomChercheur, equipe.NOM AS NomEquipe 
         FROM ". $this->table_name ." INNER JOIN equipe ON chercheur.NE = equipe.NE";

        try
        {
            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Exécution de la requête
            $stmt->execute();

            // On récupère le résultat
            $chercheur = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $chercheur;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de la recuperation des chercheurs";
        }

    }

    public function getChercheurById($nc)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        try {
            // requête pour récupérer le chercheur en fonction du numéro chercheur (nc)
            $sql= "SELECT * FROM ". $this->table_name ." WHERE NC = :nc";

            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // liage des params
            $stmt->bindParam(':nc', $nc);

            // Exécution de la requête
            $stmt->execute();

            // Récupération des données
            $chercheur = $stmt->fetch(PDO::FETCH_ASSOC);

            return $chercheur;
        }
        catch (PDOException $e)
        {
            return "Il n'existe pas de chercheur avec ce numéro";
        }

    }

    public function updateChercheur($nc, $nom, $prenom, $ne)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour update les données d'un chercheur en fonction de son numéro
        $sql = "UPDATE ". $this->table_name ." SET NOM = :nom, PRENOM = :prenom, NE = :ne WHERE NC = :nc";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':nc', $nc);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':ne', $ne);

        // Exécution de la requête
        if($stmt->execute())
        {
            return "Chercheur mis à jour avec succès";
        }
        else
        {
            return "Une erreur est survenue lors de la mise à jour";
        }
    }

    public function deleteChercheur($nc)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour supprimer un chercheur en fonction de son numéro
        $sql = "DELETE  FROM ". $this->table_name ." WHERE NC = :nc";

        // Préparation de la requête
        $stmt = $conn->prepare($sql);

        // Liage des params
        $stmt->bindParam(':nc', $nc);

        // Exécution de la requête
        if($stmt->execute())
        {
            return "Chercheur supprime avec succes";
        }
        else
        {
            return "Il nexiste pas de chercheur avec ce numero";
        }

    }

}