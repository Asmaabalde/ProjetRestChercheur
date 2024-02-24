<?php
// Affichage des projets dont le budget est entre 400000 et 900000 euros
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/projet.php');
$projet = new Projet();
$data = json_decode(file_get_contents('php://input'));
$result = $projet->getProjetbyBudget();
header('Content-Type: application/json');
echo json_encode($result);
?>
