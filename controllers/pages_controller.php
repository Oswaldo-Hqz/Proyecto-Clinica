<?php
  class PagesController {
    public function home() {
      $tiposU = Pages::tipos();
      $turnos = Pages::turnos();
      $horarios = Pages::Horarios();
      require_once('views/pages/home.php');
    }

    public function error() {
      require_once('views/pages/error.php');
    }
  }
?>