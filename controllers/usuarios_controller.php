<?php
  class UsuariosController {
    public function home() {
      $tiposU = obtener::tipos();
      $turnos = obtener::turnos();
      $horarios = obtener::Horarios();
      $usuarios = ObtenerUsuario::obtenerUsuarios();
      $TableTipoU = obtener::obtenertipoU();
      require_once('views/Administrador/usuarios/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>