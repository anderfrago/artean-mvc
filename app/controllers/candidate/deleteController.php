<?php

//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dirname(__FILE__) . '/../../persistence/DAO/CandidateDAO.php');
require_once(dirname(__FILE__) . '/../../app/models/Candidate.php');

$creatureDAO = new CandidateDAO();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
//Llamo que hace la edición contra BD
    deleteAction();
}

function deleteAction() {
    $id = $_GET["id"];

    $creatureDAO = new CandidateDAO();
    $creatureDAO->delete($id);

    header('Location: ../../index.php');
}
?>

