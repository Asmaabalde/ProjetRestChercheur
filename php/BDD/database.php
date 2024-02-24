<?php

// Création d'une class pour gérer la connexion à la base de données
class Database
{
    // Déclaration des propriétés
    // Le nom de l'host
    private $host = "localhost";
    // nom de la BDD
    private $db = "recherche";
    // nom du user
    private $user = "root";
    // le mdp
    private $pass = "";

    // Propriété publique qui stockera l'objet de connexion
    // public pour permettre l'accès hors de la class
    public $conn;

    // Méthode publique pour établir la connexion à la base de données
    public function getConnection(){
        // Initialise la connexion à null
        // This fait référence à l'instance de l'objet actuel
        $this->conn = null; // pour qu'il n'y ait pas d'ancienne connexion
        try{
            // l'objet connexion de la class database
            // On essaie de créer une nouvelle connexion
            $this->conn = new PDO("mysql:host=".$this->host.
                ";dbname=" .$this->db, $this->user,$this->pass);

            // Définition de l'encodage des caractères à UTF-8
            $this->conn->exec("set names utf8");//qui est couramment utilisé pour prendre en charge une variété de caractères internationaux.
        }
            // si la partie try ne marche pas comme prévue
        catch(PDOException $exception){
            // Retourne l'objet de connexion
            echo "database connection failed: ".$exception->getMessage();
        }
        // Retourne l'objet de connexion
        return $this ->conn;
    }
}