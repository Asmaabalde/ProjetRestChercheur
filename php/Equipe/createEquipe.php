<?php
// Ajout d'une nouvelle équipe dans la table 'equipe'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/equipe.php');
$equipe = new Equipe();
$data = json_decode(file_get_contents('php://input'));
$ne = $data->ne;
$nom = $data->nom;
$result = $equipe->addEquipe($ne,$nom);
header('Content-Type: application/json');
echo json_encode($result);
?>
