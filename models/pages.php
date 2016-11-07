<?php
  class Pages {
    public $id;
    public $tipoUsuario;

    public function __construct($id, $tipoUsuario) {
      $this->id      = $id;
      $this->tipoUsuario  = $tipoUsuario;
    }
    //Obtiene ul listado de todos los tipos de usuario
    public static function tipos() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM tipoUsuarios');
      foreach($req->fetchAll() as $tipos) {
        $list[] = new Pages($tipos['tipoUsuarioId'], $tipos['tipo']);
      }
      return $list;
    }
    //Obtiene el id y nombre de los turnos que existen
    public static function turnos() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT turnoid,Nombre FROM turnos');
      foreach($req->fetchAll() as $turnos) {
        $list[] = new Pages($turnos['turnoid'], $turnos['Nombre']);
      }
      return $list;
    }
    //Obtiene el id y nombre de los horarios que existen
    public static function Horarios() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT detalleturnoid, nombreturno FROM detalleturnos');
      foreach($req->fetchAll() as $horarios) {
        $list[] = new Pages($horarios['detalleturnoid'], $horarios['nombreturno']);
      }
      return $list;
    }
    //Iserta un usario a la BD
    public static function ingresarUsuario($codigo, $nombres, $apellidos, $tipoU, $telefono, $direccion, $email, $passWord, $turno, $foto){
      $codigo = strip_tags($codigo);
      $codigo = htmlspecialchars($codigo);
      $nombres = strip_tags($nombres);
      $nombres = htmlspecialchars($nombres);
      $apellidos = strip_tags($apellidos);
      $apellidos = htmlspecialchars($apellidos);  
      $tipoU = strip_tags($tipoU);
      $tipoU = htmlspecialchars($tipoU);  
      $telefono = strip_tags($telefono);
      $telefono = htmlspecialchars($telefono); 
      $direccion = strip_tags($direccion);
      $direccion = htmlspecialchars($direccion); 
      $email = strip_tags($email);
      $email = htmlspecialchars($email); 
      $passWord = strip_tags($passWord);
      $passWord = htmlspecialchars($passWord);
      $password = hash('sha256', $passWord);
      $turno = strip_tags($turno);
      $turno = htmlspecialchars($turno); 
      $db = Db::getInstance();
      $db->query("INSERT INTO usuarios(codigoUsuario, nombres, apellidos, correo, passw, photo, telefono, direccion, turnoId, tipoUsuarioId) VALUES ('$codigo','$nombres','$apellidos','$email','$password','$foto','$telefono','$direccion',$turno,$tipoU)");
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

    public static function ingresarTipoUser($Nombre){
      $db = Db::getInstance();
      $result = $db->query('SELECT count(*) FROM tipousuarios');
      $valor = $result->fetch();
      $Catidad = $valor[0];
      $Catidad++;
      $db->query("INSERT INTO tipousuarios(tipoUsuarioId, tipo) VALUES ('$Catidad','$Nombre')");
    } 
  }
?>