<?php
// Affichage d'un projet en particulier en fonction de son numéro np
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/projet.php');
$projet = new Projet();
$data = json_decode(file_get_contents('php://input'));
$np = $data->np;
$result = $projet->getProjetById($np);
header('Content-Type: application/json');
echo json_encode($result);
?>
