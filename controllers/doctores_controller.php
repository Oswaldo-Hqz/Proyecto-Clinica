<?php
  class DoctoresController {
    public function home() {
      $DatosUsuario = Obtener::DatosUsuario();
      $Especialidad = ObtenerEsp::obtenerespecialidad();
      $Doctores = ObtenerDoc::obtenerDoctores();
      $Especialidades = Obtener::Especialidad();
      require_once('views/doctores/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>