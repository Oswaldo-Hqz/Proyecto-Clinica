<?php
  class PagesController {
    public function home() {
      $tiposU = Pages::tipos();
      $turnos = Pages::turnos();
      $horarios = Pages::Horarios();
      $usuarios = ObtenerUsuario::obtenerUsuarios();
      $TableHorario = ObtenerHorarios::obtenerHorario();
      $TableTipoU = pages::obtenertipoU();
      $DatosUsuario = Obtener::DatosUsuario();
      $Especialidad = pages::obtenerespecialidad();
      require_once('views/Administrador/pages/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>