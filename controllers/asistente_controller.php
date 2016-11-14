<?php
  class AsistenteController {
    public function home() {
      $tipoSang = Obtener::tipoSaguineo();
      require_once('views/Asistente/dashboard/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>