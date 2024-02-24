<?php
// Mise à jour des données d'un projet en fonction de son numéro np
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/projet.php');
$projet = new Projet();
$data = json_decode(file_get_contents('php://input'));
$np = $data->np;
$nom = $data->nom;
$budget = $data->budget;
$ne = $data->ne;
$result = $projet->updateProjet($np, $nom,$budget,$ne);
header('Content-Type: application/json');
echo json_encode($result);
?>
