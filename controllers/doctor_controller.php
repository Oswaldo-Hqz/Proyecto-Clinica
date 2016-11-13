<?php
  class DoctorController {
    public function home() {

      require_once('views/Doctor/dashboard/home.php');
    }

    public function error() {
      require_once('views/Error/error.php');
    }
  }
?>