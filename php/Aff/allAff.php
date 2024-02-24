<?php
// Affichage de tous les élément se trouvant dans la table 'aff'
header("Access-Control-Allow-Origin: *");
include_once(__DIR__ . '/../../php/Class/aff.php');
$aff = new Aff();
$data = json_decode(file_get_contents('php://input'));
$result = $aff->getAff();
header('Content-Type: application/json');
echo json_encode($result);
?>
