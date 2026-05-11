<?php
// Gael Guerra
    require_once("../../controllers/torneosController.php");
    $objTorneosController = new torneosController();
    $objTorneosController->delete($_GET['id']);
?>