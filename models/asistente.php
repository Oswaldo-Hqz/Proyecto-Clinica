<?php 
	
	class Obtener{
		public $id;
		public $Val1;
		function __construct($id, $Val1){
	      	$this->id      	= $id;
      		$this->Val1  	= $Val1;
		}

		public static function tipoSaguineo() {
		    $list = [];
		    $db = Db::getInstance();
		    $req = $db->query('SELECT * FROM tiposangre');
		    foreach($req->fetchAll() as $tipos) {
		        $list[] = new Obtener($tipos['tipoSangreID'], $tipos['GrupoSanguineo']);
		    }
		    return $list;
	    }
	}

	class Ingresar{

		function __construct(){

		}

		public static function Paciente($codigo, $Nombres, $apellidos, $Genero, $Edad, $FechaN, $LugarN, $ocupacion, $direccion, $DUI, $Telefono, $Peso, $Estatura, $TipoSangre,$VIH,$Alergias,$Medicamentos,$Enfermedades){
		      $codigo = strip_tags($codigo);
		      $codigo = htmlspecialchars($codigo);		      
		      $Nombres = strip_tags($Nombres);
		      $Nombres = htmlspecialchars($Nombres);
		      $apellidos = strip_tags($apellidos);
		      $apellidos = htmlspecialchars($apellidos);  
		      $Genero = strip_tags($Genero);
		      $Genero = htmlspecialchars($Genero);  
		      $Edad = strip_tags($Edad);
		      $Edad = htmlspecialchars($Edad); 
		      $FechaN = strip_tags($FechaN);
		      $FechaN = htmlspecialchars($FechaN); 
		      $LugarN = strip_tags($LugarN);
		      $LugarN = htmlspecialchars($LugarN); 
		      $ocupacion = strip_tags($ocupacion);
		      $ocupacion = htmlspecialchars($ocupacion);
		      $direccion = strip_tags($direccion);
		      $direccion = htmlspecialchars($direccion);
		      $DUI = strip_tags($DUI);
		      $DUI = htmlspecialchars($DUI);
		      $Telefono = strip_tags($Telefono);
		      $Telefono = htmlspecialchars($Telefono);
		      $Peso = strip_tags($Peso);
		      $Peso = htmlspecialchars($Peso);
		      $Estatura = strip_tags($Estatura);
		      $Estatura = htmlspecialchars($Estatura);
		      $TipoSangre = strip_tags($TipoSangre);
		      $TipoSangre = htmlspecialchars($TipoSangre);
  		      $VIH = strip_tags($VIH);
		      $VIH = htmlspecialchars($VIH);
		      $Alergias = strip_tags($Alergias);
		      $Alergias = htmlspecialchars($Alergias);
		      $Medicamentos = strip_tags($Medicamentos);
		      $Medicamentos = htmlspecialchars($Medicamentos);
		      $Enfermedades = strip_tags($Enfermedades);
		      $Enfermedades = htmlspecialchars($Enfermedades);

		      $IMC = (intval($Peso))/((intval($Estatura)/100)*(intval($Estatura)/100));

		      
		      $db = Db::getInstance();
		      $db->query("
		      	INSERT INTO 
		      	pacientes(codigoPaciente, Nombres, Apellidos, sexo, edad, pesoKilo, IMC, estatura, FechaNacimiento, LugarNacimiento, Ocupacion, VIH, DUI, direccion, telefono, tipoSangreID, foto, alergias, medicamentoActual, Enfermedades) 
		      	VALUES 
		      	('$codigo','$Nombres','$apellidos','$Genero','$Edad',$Peso,'$IMC','$Estatura','$FechaN','$LugarN','$ocupacion','$VIH','$DUI','$direccion','$Telefono','$TipoSangre',NULL,'$Alergias','$Medicamentos','$Enfermedades')");
	    }
	}
?>