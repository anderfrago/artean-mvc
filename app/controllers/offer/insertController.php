<?php
//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dirname(__FILE__) . '/../../../persistence/DAO/OfferDAO.php');
require_once(dirname(__FILE__) . '/../../../app/models/Offer.php');
require_once(dirname(__FILE__) . '/../../../app/models/validations/ValidationsRules.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //Llamo a la función en cuanto se redirige el action a esta página mediante metodo POST
   createAction();
}
// Función encargada de crear nuevas ofertas
function createAction() {
    // Obtención de los valores del formulario y validación
    $company = ValidationsRules::test_input($_POST["company"]);
    $position = ValidationsRules::test_input($_POST["position"]);
    $function = ValidationsRules::test_input($_POST["function"]);
    // Creación de objeto auxiliar   
    $offer = new Offer();
    $offer->setCompany($company);
    $offer->setPosition($position);
    $offer->setFunction($function);
    //Creamos un objeto OfferDAO para hacer las llamadas a la BD
    $offerDAO = new OfferDAO();
    $offerDAO->insert($offer);
 
    header('Location: ../../../index.php');
}
?>

