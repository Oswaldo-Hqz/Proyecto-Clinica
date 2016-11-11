<?php 
  class obtener {
    public $id;
    public $valor1;

    public function __construct($id, $valor1) {
      $this->id      = $id;
      $this->valor1  = $valor1;
    }
    //Obtiene ul listado de todos los tipos de usuario
    public static function tipos() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT * FROM tipoUsuarios');
      foreach($req->fetchAll() as $tipos) {
        $list[] = new obtener($tipos['tipoUsuarioId'], $tipos['tipo']);
      }
      return $list;
    }
    //Obtiene el id y nombre de los turnos que existen
    public static function turnos() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT turnoid,Nombre FROM turnos');
      foreach($req->fetchAll() as $turnos) {
        $list[] = new obtener($turnos['turnoid'], $turnos['Nombre']);
      }
      return $list;
    }
    //Obtiene el id y nombre de los horarios que existen
    public static function Horarios() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT detalleturnoid, nombreturno FROM detalleturnos');
      foreach($req->fetchAll() as $horarios) {
        $list[] = new obtener($horarios['detalleturnoid'], $horarios['nombreturno']);
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
  class IngresarUsuario {

    public function __construct() {
    }

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
  }
?>