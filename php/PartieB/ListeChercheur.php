<?php
// Affichage des  chercheurs en précisant pour chacun le nom de l’équipe à laquelle il appartient
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/chercheur.php');
$chercheur = new Chercheur();
$data = json_decode(file_get_contents('php://input'));
$result = $chercheur->getChercheurAndNomEquipe();
header('Content-Type: application/json');
echo json_encode($result);
?>
