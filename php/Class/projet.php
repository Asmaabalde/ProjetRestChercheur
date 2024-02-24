<?php

// Inclusion du fichier contenant la classe Database
include_once(__DIR__ . '/../BDD/database.php');

// Classe pour gérer les opérations CRUD sur la table "projet"
class Projet
{
    // propriété privée contenant le nom de la table pour pouvoir y accéder dans les fonctions
    private $table_name = 'projet';

    // Méthode pour créer un nouveau projet
    public function addProjet($np, $nom, $budget, $ne)
    {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour insérer un nouveau projet dans la table "projet"
        $sql = "INSERT INTO " . $this->table_name . " (NP, NOM, BUDGET, NE) VALUES (:np, :nom, :budget, :ne)";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':np', $np);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':ne', $ne);

        // Exécution de la requête
        if ($stmt->execute()) {
            return "ajout du projet reussi";
        }
        else
        {
            return "erreur lors de la creation du projet";
        }
    }

    // Méthode pour récupérer tous les projets
    public function getProjet() {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour sélectionner tous les projets
        $sql = "SELECT * FROM " . $this->table_name;

        try {
            // Préparer la requête
            $stmt = $conn->prepare($sql);

            // Exécution de la requête
            $stmt->execute();

            // Récupérer les résultats
            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $projets;
        } catch (PDOException $e) {
            return "Une erreur est survenue"; // En cas d'erreur, retourner null
        }
    }

    public function getProjetById($np)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour récupérer un projet en fonction de son numéro
        $sql = "SELECT * FROM ". $this->table_name ." WHERE NP = :np";

        try
        {
            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Liage des paramètres
            $stmt->bindParam(':np', $np);

            // Exécution de la requête
            $stmt->execute();

            // Récupération des données
            $projet = $stmt->fetch(PDO::FETCH_ASSOC);

            return $projet;
        }
        catch (PDOException $e )
        {
            return "Pas de projet avec ce numéro";
        }
    }

    // Méthode pour récupérer les budgets triés par ordre décroissant et sans doublons
    public function getBudgetOrderDesc()
    {
        // Connexion à la BDD
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL
        $sql = "SELECT DISTINCT BUDGET FROM ". $this->table_name ." ORDER BY BUDGET DESC";

        try
        {
            // Préparation de la requête
            $stmt=$conn->prepare($sql);

            //Exécution
            $stmt->execute();

            // Récupération des données
            $budgets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $budgets;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de la recuperation des budgets";
        }
    }

    // Méthode pour récupérer tous les projets dont le budget est entre 400000 et 900000 euros
    public function getProjetbyBudget()
    {
        // Connexion à la BDD
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL
        $sql = "SELECT * FROM ". $this->table_name ." WHERE BUDGET BETWEEN 400000 AND 900000";

        try
        {
            // préparation de la requête
            $stmt = $conn->prepare($sql);

            // Exécution
            $stmt->execute();

            // Récupération du résultat
            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $projets;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de la recuperation des projets";
        }
    }

    // Partie C
    // Méthode pour lister les projets dont le budget est supérieur à un budget quelconque de l’année 2018.
    public function getProjetByBudgetAndAnne()
    {
        // Connexion à la BDD
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL
        $sql = "SELECT p.* FROM projet p
                JOIN aff a ON p.NP = a.NP
                WHERE p.BUDGET > ANY (SELECT BUDGET FROM projet
                JOIN aff ON projet.NP = aff.NP
                WHERE aff.ANNEE = 2018)";

        try
        {
            // préparation de la requête
            $stmt = $conn->prepare($sql);

            // Exécution
            $stmt->execute();

            // Récupération du résultat
            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $projets;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de la recuperation des projets";
        }
    }

    // Partie C
    // Méthode pour Lister les projets auxquels sont affectés les chercheurs « BOUGUEROUA » et « WOLSKA ».
    public function getProjetLikeChercheur()
    {
        // Connexion à la BDD
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL
        $sql = "SELECT DISTINCT p.* FROM projet p
                JOIN aff a ON p.NP = a.NP
                JOIN chercheur c ON a.NC = c.NC
                WHERE c.NOM IN ('BOUGUEROUA', 'WOLSKA')";

        try
        {
            // préparation de la requête
            $stmt = $conn->prepare($sql);

            // Exécution
            $stmt->execute();

            // Récupération du résultat
            $projets = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $projets;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de la recuperation des projets";
        }
    }


    // Méthode pour mettre à jour un projet
    public function updateProjet($np, $nom, $budget, $ne) {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour mettre à jour un projet dans la table "projet"
        $sql = "UPDATE " . $this->table_name . " SET NOM = :nom, BUDGET = :budget, NE = :ne WHERE NP = :np";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':np', $np);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':ne', $ne);

        // Exécution de la requête
        if($stmt->execute()) {
            return "Projet mis à jour avec succès";
        }
        else
        {
            return "Une erreur est survenue lors de la mise à jour du projet";
        }

    }

    // Méthode pour supprimer un projet
    public function deleteProjet($np) {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour supprimer un projet de la table "projet"
        $sql = "DELETE FROM " . $this->table_name . " WHERE NP = :np";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':np', $np);

        // Exécution de la requête
        if($stmt->execute()) {
            return "Projet supprimer avec succès";
        }
        else
        {
            return "Une erreur est survenue lors de la suppréssion du projet";
        }
    }

}
?>
