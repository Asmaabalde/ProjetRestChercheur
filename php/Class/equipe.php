<?php

// Inclusion du fichier contenant la classe Database
include_once(__DIR__ . '/../BDD/database.php');


// Classe pour gérer les opérations CRUD sur la table "equipe"
class Equipe {

    // propriété privée contenant le nom de la table pour pouvoir y accéder dans les fonctions
    private $table_name = 'equipe';

    // Méthode pour créer une nouvelle équipe
    public function addEquipe($ne, $nom) {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour insérer une nouvelle équipe dans la table "equipe"
        $sql = "INSERT INTO ". $this->table_name ."(NE,NOM) VALUES (:ne, :nom)";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':ne', $ne);
        $stmt->bindParam(':nom', $nom);

        // Exécution de la requête
        if($stmt->execute()) {
            return 'equipe ajoutee avec succes';
        }
        else
        {
            return "Erreur survenue lors de lajout";
        }

    }

    // Méthode pour récupérer toutes les équipes
    public function getEquipe() {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour sélectionner toutes les équipes
        $sql = "SELECT * FROM ". $this->table_name;

        try {
            // Préparer la requête
            $stmt = $conn->prepare($sql);

            // Exécution de la requête
            $stmt->execute();

            // Récupérer les résultats
            $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $equipes;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue"; // En cas d'erreur, retourner null
        }

    }

    // Méthode pour lister les noms de toutes les équipes et le nombre de projets qui leur appartiennent
    public function getEquipesWithProjectCounts() {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour sélectionner les noms des équipes et le nombre de projets qui leur appartiennent
        $sql = "SELECT e.NOM AS NomEquipe, COUNT(p.NE) AS NombreProjets
            FROM equipe e
            LEFT JOIN projet p ON e.NE = p.NE
            GROUP BY e.NOM";

        try {
            // Préparer la requête
            $stmt = $conn->prepare($sql);

            // Exécuter la requête
            $stmt->execute();

            // Récupérer les résultats
            $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $equipes;
        } catch (PDOException $e) {
            return "Une erreur est survenue lors de la récupération des équipes et des projets";
        }
    }


    // Méthode pour récupérer une équipe en fonction de son numéro
    public function getEquipeById($ne)
    {
        // Connexion à la BDD
        $database = new database();
        $conn = $database->getConnection();

        // Requête pour récupérer l'équipe
        $sql = "SELECT * FROM ". $this->table_name ." WHERE NE = :ne";

        try
        {
            // Préparation de la requête
            $stmt = $conn->prepare($sql);

            // Liaison des params
            $stmt->bindParam(':ne', $ne);

            // Exécution de la requête
            $stmt->execute();

            // Récupération des résultats
            $equipe = $stmt->fetch(PDO::FETCH_ASSOC);

            return $equipe;
        }
        catch (PDOException $e)
        {
            return "Une erreur est survenue lors de l\'opération";
        }
    }

    // Méthode pour mettre à jour une équipe
    public function updateEquipe($ne, $nom) {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour mettre à jour une équipe dans la table "equipe"
        $sql = "UPDATE ". $this->table_name ." SET NOM = :nom WHERE NE = :ne";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':ne', $ne);
        $stmt->bindParam(':nom', $nom);

        // Exécution de la requête
        if($stmt->execute()) {
            return "Mise à jour réussie";
        }
        else
        {
            return "Une erreur est survenue lors de la mise à jour";
        }
    }

    // Méthode pour supprimer une équipe
    public function delete($ne) {
        $database = new Database();
        $conn = $database->getConnection();

        // Requête SQL pour supprimer une équipe de la table "equipe"
        $sql = "DELETE FROM ". $this->table_name ." WHERE NE = :ne";

        // Préparer la requête
        $stmt = $conn->prepare($sql);

        // Liage des paramètres
        $stmt->bindParam(':ne', $ne);

        // Exécution de la requête
        if($stmt->execute()) {
            return "Suppression reussie";
        }
        else
        {
            return "Une erreur est survenue lors de la suppression";
        }
    }
}