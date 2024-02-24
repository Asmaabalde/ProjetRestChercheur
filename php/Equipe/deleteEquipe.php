<?php
// Suppréssion d'une équipe en fonction de son numéro ne
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/equipe.php');
$equipe = new Equipe();
$data = json_decode(file_get_contents('php://input'));
$ne = $data->ne;
$result = $equipe->delete($ne);
header('Content-Type: application/json');
echo json_encode($result);
?>
