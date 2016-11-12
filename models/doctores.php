<?php 
	
	class ingresar{
		
		function __construct(){
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

    public static function Especialidad() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT especialidadID, nombre, descripcion FROM especialidades');
      foreach($req->fetchAll() as $listEsp) {
        $list[] = new Obtener($listEsp['especialidadID'], $listEsp['nombre'], $listEsp['descripcion']);
      }
      return $list;
    } 
  }

  class ObtenerEsp{
    public $id;
    public $Var1;

    public function __construct($id, $Var1) {
      $this->id = $id;
      $this->Var1 = $Var1;
    }
    public static function obtenerespecialidad() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT especialidadID, nombre FROM especialidades');
      foreach($req->fetchAll() as $listEspecialidad) {
        $list[] = new ObtenerEsp($listEspecialidad['especialidadID'], $listEspecialidad['nombre']);
      }
      return $list;
    }   
  }

  class ObtenerDoc{
    public $id;
    public $Especialidad;
    public $Nombres;
    public $Apellidos;
    public $Email;
    public $Telefono;

    public function __construct($id, $Especialidad, $Nombres, $Apellidos, $Email, $Telefono) {
      $this->id = $id;
      $this->Especialidad = $Especialidad;
      $this->Nombres = $Nombres;
      $this->Apellidos = $Apellidos;
      $this->Email = $Email;
      $this->Telefono = $Telefono;
    }
    public static function obtenerDoctores() {
      $list = [];
      $db = Db::getInstance();
      $req = $db->query('SELECT codigoDoctor,e.nombre , u.nombres, u.apellidos, u.correo, u.telefono FROM doctores d INNER JOIN usuarios u ON u.codigoUsuario = d.codigoUsuario INNER JOIN especialidades e ON e.especialidadID = d.especialidadID');
      foreach($req->fetchAll() as $listDoc) {
        $list[] = new ObtenerDoc($listDoc['codigoDoctor'], $listDoc['nombre'], $listDoc['nombres'], $listDoc['apellidos'], $listDoc['correo'], $listDoc['telefono']);
      }
      return $list;
    }   
  }
?>