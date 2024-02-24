<?php
// Ajout d'un nouveau chercheur dans la table 'chercheur'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/aff.php');
$aff = new aff();
$data = json_decode(file_get_contents('php://input'));
$np = $data->np;
$nc = $data->nc;
$annee = $data->annee;
$result = $aff->addAff($np,$nc,$annee);
header('Content-Type: application/json');
echo json_encode($result);
?>
