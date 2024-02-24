<?php
// Suppréssion d'un chercheur en fonction de son numéro nc
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/chercheur.php');
$chercheur = new Chercheur();
$data = json_decode(file_get_contents('php://input'));
$nc = $data->nc;
$result = $chercheur->deleteChercheur($nc);
header('Content-Type: application/json');
echo json_encode($result);
?>
>