<?php
// Mise à jour des données d'un projet en fonction de son numéro np
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/aff.php');
$aff = new Aff();
$data = json_decode(file_get_contents('php://input'));
$np = $data->np;
$nc = $data->nc;
$annee= $data->annee;
$result = $aff->updateAff($np, $nc,$annee);
header('Content-Type: application/json');
echo json_encode($result);
?>
