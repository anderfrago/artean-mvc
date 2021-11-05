<?php
//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dirname(__FILE__) . '/../../../persistence/DAO/CandidateDAO.php');
require_once(dirname(__FILE__) . '/../../models/Candidate.php');
require_once(dirname(__FILE__) . '/../../models/validations/ValidationsRules.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Llamo a la función en cuanto se redirige el action a esta página mediante metodo POST
    createAction();
}
// Función encargada de crear nuevos candidatos
function createAction() {
    // Obtención de los valores del formulario y validación
    $name = ValidationsRules::test_input($_POST["name"]);
    $surname = ValidationsRules::test_input($_POST["surname"]);
    $email = ValidationsRules::test_input($_POST["email"]);
    // Creación de objeto auxiliar
    $candidate = new Candidate();
    $candidate->setName($name );
    $candidate->setSurname($surname);
    $candidate->setEmail($email);
    //Creamos un objeto CandidateDAO para hacer las llamadas a la BD
    $candidateDAO = new CandidateDAO();
    $candidateDAO->insert($candidate);
    
    header('Location: ../../../private/views/index.php');    
}
?>

