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
      $foto =  $db->quote($foto); 
      $db->query("INSERT INTO usuarios(codigoUsuario, nombres, apellidos, correo, passw, photo, telefono, direccion, turnoId, tipoUsuarioId) VALUES ('$codigo','$nombres','$apellidos','$email','$password',$foto,'$telefono','$direccion',$turno,$tipoU)");
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

    public static function ingresarDoctor($DocID,$UserID, $Especialidad){
      $db = Db::getInstance();      
      $db->query("INSERT INTO doctores(codigoDoctor, codigoUsuario, especialidadID) VALUES ('$DocID','$UserID','$Especialidad')");
    }

    public static function ingresarEspecialidad($Nombre,$descripcion){
      $db = Db::getInstance();
      $result = $db->query('SELECT count(*) FROM especialidades');
      $valor = $result->fetch();
      $Catidad = $valor[0];
      $Catidad++;
      $db->query("INSERT INTO especialidades(especialidadID, nombre, descripcion) VALUES ('$Catidad','$Nombre','$descripcion')");
    }



    public static function obtenertipoU() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT tipoUsuarioId, tipo FROM tipousuarios');
      foreach($req->fetchAll() as $listTipoU) {
        $list[] = new Pages($listTipoU['tipoUsuarioId'], $listTipoU['tipo']);
      }
      return $list;
    }
    public static function obtenerespecialidad() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT especialidadID, nombre FROM especialidades');
      foreach($req->fetchAll() as $listEspecialidad) {
        $list[] = new Pages($listEspecialidad['especialidadID'], $listEspecialidad['nombre']);
      }
      return $list;
    }


  }



  class ObtenerUsuario {
    public $codigoUsuario;
    public $nombres;
    public $apellidos;
    public $correo;
    public $telefono;
    public $tipousuario;

    public function __construct($codigoUsuario, $nombres, $apellidos, $correo, $telefono, $tipousuario) {
      $this->codigoUsuario = $codigoUsuario;
      $this->nombres       = $nombres;
      $this->apellidos     = $apellidos;
      $this->correo        = $correo;
      $this->telefono      = $telefono;
      $this->tipousuario   = $tipousuario;
    }
    public static function obtenerUsuarios() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT codigoUsuario,nombres,apellidos,correo,telefono,tipo 
                          FROM usuarios u 
                          inner join tipousuarios tu 
                          on tu.tipoUsuarioid = u.tipoUsuarioid');
      foreach($req->fetchAll() as $listUsuarios) {
        $list[] = new ObtenerUsuario($listUsuarios['codigoUsuario'], $listUsuarios['nombres'], $listUsuarios['apellidos'], $listUsuarios['correo'], $listUsuarios['telefono'], $listUsuarios['tipo']);
      }
      return $list;
    }
  }


  class ObtenerHorarios{
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
        $list[] = new ObtenerHorarios($listHorario['detalleturnoid'], $listHorario['nombreturno'], $listHorario['horario']);
      }
      return $list;
    }    
  }

  class Obtener{
    public $id;
    public $Var1;
    public $Var2;
    public function __construct($id, $Var1, $Var2) {
      $this->id = $id;
      $this->Var1 = $Var1;
      $this->Var2 = $Var2;      
    }
    public static function DatosUsuario() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT codigoUsuario, nombres, apellidos FROM usuarios WHERE tipoUsuarioId = 2');
      foreach($req->fetchAll() as $listHorario) {
        $list[] = new Obtener($listHorario['codigoUsuario'], $listHorario['nombres'], $listHorario['apellidos']);
      }
      return $list;
    }    
  }



?>