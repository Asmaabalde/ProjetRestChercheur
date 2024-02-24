<?php
// Ajout d'un nouveau chercheur dans la table 'chercheur'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/chercheur.php');
$chercheur = new Chercheur();
$data = json_decode(file_get_contents('php://input'));
$nc = $data->nc;
$nom = $data->nom;
$prenom = $data->prenom;
$ne = $data->ne;
$result = $chercheur->addChercheur($nc,$nom,$prenom,$ne);
header('Content-Type: application/json');
echo json_encode($result);
?>
