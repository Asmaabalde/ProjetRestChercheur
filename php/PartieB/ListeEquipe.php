<?php
// Affichage des équipes et le nombre de projets qui lui appartiennent
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/equipe.php');
$equipe = new Equipe();
$data = json_decode(file_get_contents('php://input'));
$result = $equipe->getEquipesWithProjectCounts();
header('Content-Type: application/json');
echo json_encode($result);
?>
