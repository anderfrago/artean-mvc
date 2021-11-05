<?php
//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dirname(__FILE__) . '/../../../persistence/DAO/OfferDAO.php');
require_once(dirname(__FILE__) . '/../../models/Offer.php');

$offerDAO = new OfferDAO();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
//Llamo que hace la edición contra BD
    deleteAction();
}

function deleteAction() {
    $id = $_GET["id"];

    $offerDAO = new OfferDAO();
    $offerDAO->delete($id);

    header('Location: ../../../index.php');
}
?>

