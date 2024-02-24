<?php
// Affichage de tous les chercheurs dans la table 'chercheur'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/chercheur.php');
$chercheur = new Chercheur();
$data = json_decode(file_get_contents('php://input'));
$result = $chercheur->getChercheur();
header('Content-Type: application/json');
echo json_encode($result);
?>
