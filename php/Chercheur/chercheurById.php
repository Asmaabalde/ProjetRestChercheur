<?php
// Affichage d'un chercheur en particulier en fonction de son numéro nc
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/chercheur.php');
$chercheur = new Chercheur();
$data = json_decode(file_get_contents('php://input'));
$nc = $data->nc;
$result = $chercheur->getChercheurById($nc);
header('Content-Type: application/json');
echo json_encode($result);
?>
