<?php
// Affichage de tous le projets dans la table 'projet'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/projet.php');
$projet = new Projet();
$data = json_decode(file_get_contents('php://input'));
$result = $projet->getProjet();
header('Content-Type: application/json');
echo json_encode($result);
?>
