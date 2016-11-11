<?php 
	if(isset($_POST['EnviarUsuario'])){
		if ( !isset($_FILES["foto"]) || $_FILES["foto"]["error"] > 0){
			$errTyp = "danger";
			$errMSG = "Algo ha salido mal, intente de nuevo..."; 	        	
  		}
  		else{
  			$permitidos = array("image/jpg", "image/jpeg", "image/gif", "image/png");
	        $limite_kb = 16384;
	        if (in_array($_FILES['foto']['type'], $permitidos) && $_FILES['foto']['size'] <= $limite_kb * 1024){
	          	$imagen_temporal  = $_FILES['foto']['tmp_name'];          
	          	$tipo = $_FILES['foto']['type'];
	          	$fp     = fopen($imagen_temporal, 'r+b');
	          	$data = fread($fp, filesize($imagen_temporal));
	          	fclose($fp);
        	  	$data = mysql_escape_string($data);

          	   	IngresarUsuario::ingresarUsuario(trim($_POST['codigo']), trim($_POST['nombres']), trim($_POST['apellidos']), trim($_POST['tipoU']), trim($_POST['telefono']), trim($_POST['direccion']), trim($_POST['email']), trim($_POST['passWord']), trim($_POST['turno']), $data);
          	   	$errTyp = "success";
				$errMSG = "Registro ingresado con éxito.";
	       	}
	       	else {
	       		$errTyp = "danger";
				$errMSG = "archivo no permitido, es tipo de archivo prohibido o excede el tamano de $limite_kb Kilobytes";
			}
  		}
	} 
?>

<?php
	if ( isset($errMSG) ) {              
?>
	<div class="form-group">
    	<div class="alert alert-<?php echo ($errTyp=="success") ? "success" : $errTyp; ?> fade in">
    	<button type="button" class="close" data-dismiss="alert">×</button><strong>
	      	<span class="glyphicon glyphicon-info-sign"></span> <?php echo $errMSG; ?>
	    </div>
  	</div>
<?php
    }
?> 

<!-- ************************ BUTTONS ************************ -->

<center>
	<button href="#ModalNuevoUsuario" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-user-plus fa-4x"></i> 
		<br>Crear Usuario</span>
	</button>
	<button href="#ModalEliminarUsuario" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-user-times fa-4x"></i> 
		<br>Eliminar Usuario</span>
	</button>
</center>


<!-- ************************ MODALS ************************ -->

<!--modal crear nuevo usuario start-->
<div id="ModalNuevoUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Crear Nuevo Usuario</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="return validarNuevoUsuario(this)" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
				<div class="modal-body">	
					<div class="row">												
				        <div class="col-md-4 form-group">
			        		<label for="recipient-name" class="control-label">código:</label>
				            <input id="codigo" name="codigo" type="text" class="form-control" id="recipient-name" required>
			          	</div>
          			</div>		
          			<div class="row">			
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Nombres:</label>
				            <input id="nombres" name="nombres" type="text" class="form-control" id="recipient-name" required>
			          	</div>		        
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Apellidos:</label>
				            <input id="apellidos" name="apellidos" type="text" class="form-control" id="recipient-name" required>
			          	</div>		
		          	</div>
		          	<div class="row">		
	          			<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Tipo Usuario:</label>
				            <select id="tipoU" name="tipoU" class="selectpicker show-tick form-control">
				            <?php foreach($tiposU as $ListTipos) { 
				            	echo '<option value="'.$ListTipos->id.'">'.$ListTipos->valor1.'</option>';
			            	}?>		          	
					        </select>
			          	</div>		
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Telefono:</label>
				            <input id="telefono" name="telefono" type="text" class="form-control" id="recipient-name" required>
			          	</div>	
		          	</div>		
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Dirección:</label>
			            <input id="direccion" name="direccion" type="text" class="form-control" id="recipient-name" required>
		          	</div>			
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Correo electronico:</label>
			            <input id="email" name="email" type="text" class="form-control" id="recipient-name" required>
		          	</div>		
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Contraseña:</label>
			            <input id="passWord" name="passWord" type="password" class="form-control" id="recipient-name" required>
		          	</div>		
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Foto:</label>
			            <input id="foto" name="foto" type="file" class="file" required>
		          	</div>
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Turno:</label>
			            <select id="turno" name="turno" class="selectpicker show-tick form-control">
			            <?php foreach($turnos as $ListTurnos) { 
			            	echo '<option value="'.$ListTurnos->id.'">'.$ListTurnos->valor1.'</option>';
		            	}?>		          	
				        </select>
		          	</div>		
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarUsuario" id="EnviarUsuario" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!--modal crear nuevo usuario end-->

<!--modal crear eliminar usuario start-->
<div id="ModalEliminarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Eliminar Usuario</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="return validarNuevoUsuario(this)" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
				<div class="modal-body">					
		          	<div class="row">		
	          			<div class="col-md-10 col-md-offset-1 form-group">
				            <label for="recipient-name" class="control-label">Codigo Usuario:</label>
				            <select id="tipoU" name="tipoU" class="selectpicker show-tick form-control">
				            <?php foreach($usuarios as $ListUsuarios) { 
				            	echo '<option value="'.$ListUsuarios->codigoUsuario.'">'.$ListUsuarios->codigoUsuario.' - '.$ListUsuarios->nombres.' '.$ListUsuarios->apellidos.'</option>';
			            	}?>		          	
					        </select>
			          	</div>					          	
		          	</div>				          			
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EliminarUsuario" id="EliminarUsuario" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!--modal crear eliminar usuario end-->

<!--modal crear nuevo usuario start-->
<div id="ModalModificarUsuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Modificar Usuario</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="return validarNuevoUsuario(this)" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
				<div class="modal-body">	
					<div class="row">												
				        <div class="col-md-4 form-group">
			        		<label for="recipient-name" class="control-label">código:</label>
				            <input id="codigo" name="codigo" type="text" class="form-control" id="recipient-name" required>
			          	</div>
          			</div>		
          			<div class="row">			
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Nombres:</label>
				            <input id="nombres" name="nombres" type="text" class="form-control" id="recipient-name" required>
			          	</div>		        
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Apellidos:</label>
				            <input id="apellidos" name="apellidos" type="text" class="form-control" id="recipient-name" required>
			          	</div>		
		          	</div>
		          	<div class="row">		
	          			<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Tipo Usuario:</label>
				            <select id="tipoU" name="tipoU" class="selectpicker show-tick form-control">
				            <?php foreach($tiposU as $ListTipos) { 
				            	echo '<option value="'.$ListTipos->id.'">'.$ListTipos->valor1.'</option>';
			            	}?>		          	
					        </select>
			          	</div>		
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Telefono:</label>
				            <input id="telefono" name="telefono" type="text" class="form-control" id="recipient-name" required>
			          	</div>	
		          	</div>		
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Dirección:</label>
			            <input id="direccion" name="direccion" type="text" class="form-control" id="recipient-name" required>
		          	</div>			
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Correo electronico:</label>
			            <input id="email" name="email" type="text" class="form-control" id="recipient-name" required>
		          	</div>		
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Contraseña:</label>
			            <input id="passWord" name="passWord" type="password" class="form-control" id="recipient-name" required>
		          	</div>		
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Foto:</label>
			            <input id="foto" name="foto" type="file" class="file" required>
		          	</div>
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Turno:</label>
			            <select id="turno" name="turno" class="selectpicker show-tick form-control">
			            <?php foreach($turnos as $ListTurnos) { 
			            	echo '<option value="'.$ListTurnos->id.'">'.$ListTurnos->valor1.'</option>';
		            	}?>		          	
				        </select>
		          	</div>		
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarUsuario" id="EnviarUsuario" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!--modal crear nuevo usuario end-->

<!-- ************************ TABLES ************************ -->

<!--Tabla Usuarios start-->
<div class=" panel-body1">
	<div class="table-responsive">
		<table class="table table-striped">
	 		<thead>
				<tr>
			  		<th>Codigo Usuario</th>
			  		<th>Nombres</th>
			  		<th>Apellidos</th>
			  		<th>Email</th>
			  		<th>Telefono</th>
			  		<th>Tipo Usuario</th>
			  		<th></th>
				</tr>
		  	</thead>
		  	<tbody>
			  	<?php foreach($usuarios as $ListUsers) { 
			  		echo '<tr>';
			  		echo '<th scope="row">'.$ListUsers->codigoUsuario.'</th>';
			  		echo '<td>'.$ListUsers->nombres.'</td>';
			  		echo '<td>'.$ListUsers->apellidos.'</td>';
			  		echo '<td>'.$ListUsers->correo.'</td>';
			  		echo '<td>'.$ListUsers->telefono.'</td>';
			  		echo '<td>'.$ListUsers->tipousuario.'</td>';
			  		echo '<td><button href="#ModalModificarUsuario" data-toggle="modal" type="button" class="btn btn-default"><span><i class="fa fa-pencil"></i><br></span></button></td>';
			  		echo '</tr>';
				}?>	
		  	</tbody>
		</table>
	</div>
</div>
<!--Tabla Usuarios end-->