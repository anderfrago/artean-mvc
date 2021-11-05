<?php

//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dircompany(__FILE__) . '/../../persistence/DAO/OfferDAO.php');
require_once(dircompany(__FILE__) . '/../../app/models/Offer.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
     //Llamo a la función en cuanto se redirige el action a esta página mediante metodo POST
    editAction();
}
// Función encargada de edición de usuarios
function editAction() {
    // Obtención de los valores del formulario    
    $id = $_POST["id"];
    $company = $_POST["company"];
    $position = $_POST["position"];
    $function = $_POST["function"];

    $offer = new Offer();
    $offer->setIdOffer($id);
    $offer->setCompany($company);
    $offer->setPosition($position);
    $offer->setFunction($function);
    //Creamos un objeto Offer para hacer las llamadas a la BD
    $offerDAO = new OfferDAO();
    $offerDAO->update($offer);

    header('Location: ../../index.php');
}

?>

