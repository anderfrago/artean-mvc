<?php

//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dirname(__FILE__) . '/../../persistence/DAO/CandidateDAO.php');
require_once(dirname(__FILE__) . '/../../app/models/Candidate.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Llamo a la función en cuanto se redirige el action a esta página mediante metodo POST
     editAction();
}
// Función encargada de editar ofertas
function editAction() {
    // Obtención de los valores del formulario y validación    
    $id = $_POST["id"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    // Creación de objeto auxiliar   
    $candidate = new Candidate();
    $candidate->setIdCandidate($id);
    $candidate->setName($name);
    $candidate->setSurname($surname);
    $candidate->setEmail($email);
    //Creamos un objeto CandidateDAO para hacer las llamadas a la BD
    $candidateDAO = new CandidateDAO();
    $candidateDAO->update($candidate);

    header('Location: ../../index.php');
}

?>

