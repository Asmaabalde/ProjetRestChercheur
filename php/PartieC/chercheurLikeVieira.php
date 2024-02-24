<?php
// Affichage d'un chercheur en particulier en fonction de son numéro nc
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/aff.php');
$aff = new Aff();
$data = json_decode(file_get_contents('php://input'));
$result = $aff->getChercheurAsVieira();
header('Content-Type: application/json');
echo json_encode($result);
?>
