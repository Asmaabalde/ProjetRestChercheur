<?php
// Mise à jour des données d'un projet en fonction de son numéro np
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/chercheur.php');
$chercheur = new Chercheur();
$data = json_decode(file_get_contents('php://input'));
$nc = $data->nc;
$nom = $data->nom;
$prenom = $data->prenom;
$ne = $data->ne;
$result = $chercheur->updateChercheur($nc, $nom,$prenom,$ne);
header('Content-Type: application/json');
echo json_encode($result);
?>
