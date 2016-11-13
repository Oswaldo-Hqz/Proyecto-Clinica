<?php
  class HorariosController {
    public function home() {
      $TableHorario = Horarios::obtenerHorario();
      $TableTurnos = Turnos::obtenerTurnos();
      require_once('views/Administrador/horarios/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>