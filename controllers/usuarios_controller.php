<?php
  class UsuariosController {
    public function home() {
      $tiposU = obtener::tipos();
      $turnos = obtener::turnos();
      $horarios = obtener::Horarios();
      $usuarios = ObtenerUsuario::obtenerUsuarios();
      require_once('views/usuarios/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>