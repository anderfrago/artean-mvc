<?php
//Es necesario que importemos los ficheros creados con anterioridad porque los vamos a utilizar desde este fichero.
require_once(dirname(__FILE__) . '/../../persistence/DAO/OfferDAO.php');
require_once(dirname(__FILE__) . '/../../app/models/Offer.php');
// Obtención de la lista completa de ofertas
function indexAction() {
    $offerDAO = new OfferDAO();
    return $offerDAO->selectAll();
}
?>