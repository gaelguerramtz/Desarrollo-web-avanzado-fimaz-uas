<?php
// Gael Guerra

    require_once("../../models/torneosModel.php");

    class torneosController {
        public function __construct() {
            $this->model = new torneosModel();
        }

        public function saveTorneo($nombreTorneo, $organizador, $patrocinadores, $sede, $categoria, $premio1, $premio2, $premio3, $otroPremio, $usuario, $contrasena) {
            $id= $this-> model->insert($nombreTorneo, $organizador, $patrocinadores, $sede, $categoria, $premio1, $premio2, $premio3, $otroPremio, $usuario, $contrasena);
            return ($id!=false) ? header("Location: admin.php") : header("Location: frmTorneos.php");
        }

        public function readTorneos() {
            return ($this->model->read()) ? $this->model->read() : false;
        }

        public function readOneTorneo($id) {
            return ($this->model->readOne($id) != false) ? $this->model->readOne($id) : header("Location: admin.php");
        }

        public function updateTorneo($id, $nombreTorneo, $organizador, $patrocinadores, $sede, $categoria, $premio1, $premio2, $premio3, $otroPremio) {
            return ($this->model->update($id, $nombreTorneo, $organizador, $patrocinadores, $sede, $categoria, $premio1, $premio2, $premio3, $otroPremio)) !=false ? header("Location: readOneTorneo.php?id=" .$id) : header("Location: readAllTorneos.php");
        }

        public function delete($id) {
            return ($this->model->delete($id)) ? header("Location: readAllTorneos.php") : header("Location: readOneTorneo.php?id=".$id);
        }
    }
?>
//gaelguerra