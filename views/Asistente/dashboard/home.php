<?php 
	if (isset($_POST['EnviarPaciente'])) {
		$codigo = trim($_POST['codigo']);
		$Nombres = trim($_POST['nombres']);
		$apellidos = trim($_POST['apellidos']);
		$Genero = trim($_POST['Genero']);
		$Edad = trim($_POST['Edad']);
		$FechaN = trim($_POST['FechaN']);
		$LugarN = trim($_POST['LugarN']);
		$ocupacion = trim($_POST['ocupacion']);
		$direccion = trim($_POST['direccion']);
		$DUI = trim($_POST['DUI']);
		$Telefono = trim($_POST['Telefono']);
		$Peso = trim($_POST['Peso']);
		$Estatura = trim($_POST['Estatura']);
		$TipoSangre = trim($_POST['TipoSangre']);

		if(isset($_POST['VIH'])){$VIH = 1;}
		else{$VIH = 0;}

		$Alergias = trim($_POST['Alergias']);
		$Medicamentos = trim($_POST['Medicamentos']);
		$Enfermedades = trim($_POST['Enfermedades']);

		Ingresar::Paciente($codigo, $Nombres, $apellidos, $Genero, $Edad, $FechaN, $LugarN, $ocupacion, $direccion, $DUI, $Telefono, $Peso, $Estatura, $TipoSangre,$VIH,$Alergias,$Medicamentos,$Enfermedades);

		$errTyp = "success";
		$errMSG = "Registro ingresado con éxito.";	       	
	} 
?>

<!--***************************************Mensaje***************************************-->
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
		<span><i class="fa fa-user-plus fa-3x"></i> 
		<br>Agregar Nuevo Pasiente</span>
	</button>

	<button href="#ModalCrearHorarios" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-plus-square fa-3x"></i> 
		<br>Agregar Consulta Medica</span>
	</button>	
</center>  

<!-- ************************ MODALS ************************ -->

<!--modal crear nuevo paciente start-->
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
				            <input id="codigo" name="codigo" type="text" class="form-control" required>
			          	</div>
          			</div>		
          			<div class="row">			
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Nombres:</label>
				            <input id="nombres" name="nombres" type="text" class="form-control" required>
			          	</div>		        
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Apellidos:</label>
				            <input id="apellidos" name="apellidos" type="text" class="form-control" required>
			          	</div>		
		          	</div>
		          	<div class="row">		
	          			<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Genero:</label>
				            <select id="Genero" name="Genero" class="selectpicker show-tick form-control">
					            <option value="M">Masculino</option>
					            <option value="F">Femenino</option>				            
					        </select>
			          	</div>		
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Edad:</label>
				            <input id="Edad" name="Edad" type="text" class="form-control" required>
			          	</div>
		          	</div>
		          	<div class="row">	
			          	<div class="col-md-6 form-group"> <!-- Date input -->
					        <label class="control-label" for="date">Fecha de Nacimiento:</label>
				     	    <input class="form-control" id="FechaN" name="FechaN" placeholder="MM/DD/YYY" type="text"/>
					    </div>
					    <div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Lugar de Nacimiento:</label>
				            <input id="LugarN" name="LugarN" type="text" class="form-control" required>
			          	</div>	
		          	</div>	
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Ocupación:</label>
			            <input id="ocupacion" name="ocupacion" type="text" class="form-control" required>
		          	</div>
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Dirección:</label>
			            <input id="direccion" name="direccion" type="text" class="form-control" required>
		          	</div>
		          	<div class="row">	
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">DUI:</label>
				            <input id="DUI" name="DUI" type="text" class="form-control" required>
			          	</div>	
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Telefono:</label>
				            <input id="Telefono" name="Telefono" type="text" class="form-control" required>
			          	</div>	
		          	</div>		
		          	<div class="row">		
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Peso (Kg):</label>
				            <input id="Peso" name="Peso" type="text" class="form-control" required>
			          	</div>	
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Estatura (Cm):</label>
				            <input id="Estatura" name="Estatura" type="text" class="form-control" required>
			          	</div>			
		          	</div>
		          	<div class="row">
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">Tipo de Sangre:</label>
				            <select id="TipoSangre" name="TipoSangre" class="selectpicker show-tick form-control">
				            <?php foreach($tipoSang as $ListSangre) { 
				            	echo '<option value="'.$ListSangre->id.'">'.$ListSangre->Val1.'</option>';
			            	}?>		          	
					        </select>
			          	</div>	
			          	<div class="col-md-6 form-group">
				            <label for="recipient-name" class="control-label">VIH:</label><br>
				            <center>
							<input type="checkbox" id="VIH" name="VIH" data-on-text="SI" data-off-text="NO" checked>
							</center>
			          	</div> 
		          	</div>	 
		          	
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Alergias:</label>
			            <textarea id="Alergias" name="Alergias" type="text" class="form-control" required></textarea>
		          	</div>	
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Medicamentos Actuales:</label>
			            <textarea id="Medicamentos" name="Medicamentos" type="text" class="form-control" required></textarea>
		          	</div>	
		          	<div class="form-group">
			            <label for="recipient-name" class="control-label">Enfermedades o padecimiento:</label>
			            <textarea id="Enfermedades" name="Enfermedades" type="text" class="form-control" required></textarea>
		          	</div>			          			          			
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarPaciente" id="EnviarPaciente" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!--modal crear nuevo paciente end-->