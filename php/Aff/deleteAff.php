<?php
// Suppréssion d'un chercheur en fonction de son numéro nc
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/aff.php');
$aff = new Aff();
$data = json_decode(file_get_contents('php://input'));
$np = $data->np;
$nc=$data->nc;
$annee=$data->annee;
$result = $aff->deleteAff($np, $nc, $annee);
header('Content-Type: application/json');
echo json_encode($result);
?>
