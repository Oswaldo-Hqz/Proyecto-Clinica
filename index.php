<?php
	ob_start();
	session_start();
	require_once('connection.php');  

	if ( isset($_SESSION['user']) != "" ) {//No accede si usuario no ha ingresado correctamente

	 	if (isset($_GET['controller']) && isset($_GET['action'])) {
	 	    $controller = $_GET['controller'];
	 	    $action     = $_GET['action'];
    	} 
	    else {
		    $controller = 'pages';
		    $action     = 'home';
		}

		$db = Db::getInstance();
	    $req = $db->query("SELECT nombres, apellidos, tipo, photo FROM usuarios inner join tipousuarios on tipousuarios.tipoUsuarioId = usuarios.tipoUsuarioId WHERE codigoUsuario='".$_SESSION['user']."'");
	    $results = $req->fetch();
	    $strNombre = explode(" ", $results['nombres']);
    	$_SESSION['Nombre'] = $strNombre[0];
    	$_SESSION['Apellido'] = explode(" ", $results['apellidos']);
		$_SESSION['Tipo'] = $results['tipo'];
		$_SESSION['foto'] = $results['photo'];

		require_once('views/layout.php');  
  	exit;
 	}

 	header("Location: sign-in.php");

 	$email = "";
 	$error = false;
 	$emailError = "";
 	$passError = "";

 	if( isset($_POST['btn-login']) ) { 
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		  
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
  
		if(empty($email)){
		   $error = true;
		   $emailError = "Por favor ingrese su correo.";
	  	} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
		    $error = true;
		   	$emailError = "Por favor ingrese un correo valido.";
	   	}  
	  	if(empty($pass)){
	  		$error = true;
		   	$passError = "Por favor ingrese su contraseña.";
	  	}
  
	  	if (!$error) {
		    $password = hash('sha256', $pass);    
		    $db = Db::getInstance();
		    $req = $db->query("SELECT codigoUsuario, nombres, apellidos, passw, tipo, photo FROM usuarios inner join tipousuarios on tipousuarios.tipoUsuarioId = usuarios.tipoUsuarioId WHERE correo='$email'");
		    $results = $req->fetch();
		    $count = $req->rowCount();

		    // retorna 1 si pass y usuario correctos		   
		   	if( $count == 1 && $results['passw']==$password ) {

		    	$_SESSION['user'] = $results['codigoUsuario'];
		    	if (isset($_POST['controller']) && isset($_POST['action'])) {
			 	    $controller = $_POST['controller'];
			 	    $action     = $_POST['action'];
		    	} 
			    else {
				    $controller = 'pages';
				    $action     = 'home';
				} 
				header("Location: home");
		   	} else {
		    	$errMSG = "Datos incorrectos, intente nuevamente.";
		   	}  
	   	}  
   	}

?>

<?php 
  ob_end_flush(); 
?>