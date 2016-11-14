<?php 
  class Horarios{
    public $id;
    public $Nombre;
    public $Horario;
    public function __construct($id, $Nombre, $Horario) {
      $this->id = $id;
      $this->Nombre = $Nombre;
      $this->Horario = $Horario;      
    }
    public static function obtenerHorario() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT detalleturnoid, nombreturno, horario FROM detalleturnos');
      foreach($req->fetchAll() as $listHorario) {
        $list[] = new Horarios($listHorario['detalleturnoid'], $listHorario['nombreturno'], $listHorario['horario']);
      }
      return $list;
    }

    //Inserta Nuevo horario en BD tabla detalleturno
    public static function ingresarHorario($nombreTurno, $horario){
      $db = Db::getInstance();
      $result = $db->query('SELECT count(*) FROM detalleturnos');
      $valor = $result->fetch();
      $Catidad = $valor[0];
      $Catidad++;
      $db->query("INSERT INTO detalleturnos(detalleturnoid, nombreturno, horario) VALUES ('$Catidad','$nombreTurno','$horario')");
    }     

    public static function ingresarTurno($horario, $nombre, $L, $M, $X, $J, $V, $S){
      $db = Db::getInstance();
      $result = $db->query('SELECT count(*) FROM turnos');
      $valor = $result->fetch();
      $Catidad = $valor[0];
      $Catidad++;
      $db->query("INSERT INTO turnos(turnoid, detalleturnoid, Nombre, lunes, martes, miercoles, jueves, viernes, sabado) VALUES ('$Catidad','$horario','$nombre','$L','$M','$X','$J','$V','$S')");
    }  
  }

  class Turnos{
    public $id;
    public $Nombre;
    public $nombreHorario;
    public $L;
    public $M;
    public $X;
    public $J;
    public $V;
    public $S;

    public function __construct($id, $Nombre, $nombreHorario, $L, $M, $X, $J, $V, $S){
      $this->id = $id;
      $this->Nombre = $Nombre;
      $this->nombreHorario = $nombreHorario;
      $this->L = $L;
      $this->M = $M;
      $this->X = $X;
      $this->J = $J;
      $this->V = $V;
      $this->S = $S;
    }

    public static function obtenerTurnos() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT turnoid, Nombre, nombreturno, lunes, martes, miercoles, jueves, viernes, sabado FROM turnos t INNER JOIN detalleturnos dt ON dt.detalleturnoid = t.detalleturnoid');
      foreach($req->fetchAll() as $listTurnos) {
        $list[] = new Turnos($listTurnos['turnoid'], $listTurnos['Nombre'], $listTurnos['nombreturno'], $listTurnos['lunes'], $listTurnos['martes'], $listTurnos['miercoles'], $listTurnos['jueves'], $listTurnos['viernes'], $listTurnos['sabado']);
      }
      return $list;
    }
  }

  class actualizar{
    
    function __construct(){
    }

    public static function EditHorario($id, $nombre, $horario){
      $db = Db::getInstance();
      $result = $db->query('SELECT count(*) FROM detalleturnos');      
    }   

    public static function EliminarHorario($codigo){
      $db = Db::getInstance();
      $req = $db->query("DELETE FROM detalleturnos WHERE detalleturnoid = '$codigo'");
    }
  }
?>