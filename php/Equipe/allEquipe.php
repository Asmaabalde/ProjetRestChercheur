<?php
// Affichage de toutes les équipes dans la table 'equipe'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/equipe.php');
$equipe = new Equipe();
$data = json_decode(file_get_contents('php://input'));
$result = $equipe->getEquipe();
header('Content-Type: application/json');
echo json_encode($result);
?>
