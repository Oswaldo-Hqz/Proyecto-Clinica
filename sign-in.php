<?php
	ob_start();
	session_start();
	require_once('connection.php');  
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
		    $req = $db->query("SELECT codigoUsuario, nombres, apellidos, passw FROM usuarios WHERE correo='$email'");
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

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Clinic</title>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
  <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />  
  <link rel="stylesheet" href="css/login.css" type="text/css"  />  
</head>
<body>

<div class="container">
<center><img class="img-responsive"  width="350" height="auto" src="img/logo.png" alt="Clinica Buena Salud" /> </center>
        <div class="card card-container">            
            <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
            <p id="profile-name" class="profile-name-card"></p>
            <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
                <span id="reauth-email" class="reauth-email"></span>

                <div class="form-group">
                  <input type="email" id="inputEmail" name="email" class="form-control" placeholder="Correo electronico" value="<?php echo $email; ?>" maxlength="40" required autofocus />
                  <span class="text-danger"><?php echo $emailError; ?></span>
                </div> 

                <div class="form-group">                  
                	<input type="password"  id="inputPassword" name="pass" class="form-control" placeholder="Contraseña" maxlength="15" required />
                  <span class="text-danger"><?php echo $passError; ?></span>
                </div>
                  
                <div class="form-group">
                  <button type="submit" class="btn btn-lg btn-primary btn-block btn-signin" name="btn-login">Aceptar</button>
                </div> 
                <?php
		          if ( isset($errMSG) ) {  
		        ?>
		        <div class="form-group">
		          <div class="alert alert-danger">
		            <span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
		          </div>
		        </div>
		        <?php
		          }
		        ?>                                                
            </form><!-- /form -->            
        </div><!-- /card-container -->
    </div><!-- /container -->

</body>
</html>
<?php 
  ob_end_flush(); 
?>