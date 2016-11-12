<?php 

	if (isset($_POST['EnviarEspecial'])) {
		$nombreEsp = trim($_POST['nombreEspecialidad']);
	  	$nombreEsp = strip_tags($nombreEsp);
		$nombreEsp = htmlspecialchars($nombreEsp);

		$Descripcion = trim($_POST['Descripcion']);
	  	$Descripcion = strip_tags($Descripcion);
		$Descripcion = htmlspecialchars($Descripcion);
		ingresar::ingresarEspecialidad($nombreEsp,$Descripcion);

		$errTyp = "success";
		$errMSG = "Registro ingresado con éxito.";	
	}

	if (isset($_POST['EnviarDoctor'])) {
		$CodDoctor = trim($_POST['CodDoctor']);
	  	$CodDoctor = strip_tags($CodDoctor);
		$CodDoctor = htmlspecialchars($CodDoctor);

		$UsuarioDoc = trim($_POST['UsuarioDoc']);
	  	$UsuarioDoc = strip_tags($UsuarioDoc);
		$UsuarioDoc = htmlspecialchars($UsuarioDoc);

		$EspeDoc = trim($_POST['EspeDoc']);
	  	$EspeDoc = strip_tags($EspeDoc);
		$EspeDoc = htmlspecialchars($EspeDoc);

		ingresar::ingresarDoctor($CodDoctor,$UsuarioDoc, $EspeDoc);

		$errTyp = "success";
		$errMSG = "Registro ingresado con éxito.";	
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
	<button href="#ModalNuevoMedico" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-user-md fa-4x"></i> 
		<br>Agregar Medico</span>
	</button>

	<button href="#ModalNuevaEspecialidad" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-briefcase fa-4x"></i> 
		<br>Agregar especialidad</span>
	</button>
</center>

<!-- ************************ MODALS ************************ -->

<!-- MODAL CREAR DOCTOR -->
<div id="ModalNuevoMedico" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Agregar Nuevo Doctor</h3>
			</div>
			<form method="post" onsubmit="" action="?controller=doctores&action=home" enctype="multipart/form-data">
				<div class="modal-body">		
          			<div class="row">		
          			<div class="col-md-1"></div>	
			          	<div class="col-md-10 form-group">
				            <label for="recipient-name" class="control-label">Codigo de Doctor:</label>
				            <input id="CodDoctor" name="CodDoctor" type="text" class="form-control" id="recipient-name" required>
			          	</div>	
			        </div>
			        <div class="row">		
	          			<div class="col-md-10 col-md-offset-1 form-group">
				            <label for="recipient-name" class="control-label">Usuario:</label>
				            <select id="UsuarioDoc" name="UsuarioDoc" class="selectpicker show-tick form-control">
				            <?php foreach($DatosUsuario as $ListUserDatos) { 
				            	echo '<option value="'.$ListUserDatos->id.'">'.$ListUserDatos->Var1.' '.$ListUserDatos->Var2.'</option>';
			            	}?>		          	
					        </select>
			          	</div>					          	
		          	</div>	  			        
		          	<div class="row">		
	          			<div class="col-md-10 col-md-offset-1 form-group">
				            <label for="recipient-name" class="control-label">Especialidad:</label>
				            <select id="EspeDoc" name="EspeDoc" class="selectpicker show-tick form-control">
				            <?php foreach($Especialidad as $ListEspecial) { 
				            	echo '<option value="'.$ListEspecial->id.'">'.$ListEspecial->Var1.'</option>';
			            	}?>		          	
					        </select>
			          	</div>					          	
		          	</div>
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarDoctor" id="EnviarDoctor" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL CREAR DOCTOR -->

<!-- MODAL AGREGAR ESPECIALIDAD USUARIO-->
<div id="ModalNuevaEspecialidad" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Nueva Especialidad</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="" action="?controller=doctores&action=home" enctype="multipart/form-data">
				<div class="modal-body">		
          			<div class="row">		
          			<div class="col-md-1"></div>	
			          	<div class="col-md-10 form-group">
				            <label for="recipient-name" class="control-label">Nombre:</label>
				            <input id="nombreEspecialidad" name="nombreEspecialidad" type="text" class="form-control" id="recipient-name" required>
			          	</div>	
			        </div>	  			        
			        <div class="row">		
          			<div class="col-md-1"></div>	
			          	<div class="col-md-10 form-group">
				            <label for="recipient-name" class="control-label">Descripción:</label>
				            <textarea id="Descripcion" name="Descripcion" type="text" class="form-control" id="recipient-name" required></textarea>
			          	</div>	
			        </div>	  			        
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarEspecial" id="EnviarEspecial" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL AGREGAR ESPECIALIDAD USUARIO -->



<!-- ************************ TABLES ************************ -->


<!--Tabla Usuarios start-->
<div class=" panel-body1">
	<div class="table-responsive">
		<table class="table table-striped">
	 		<thead>
				<tr>
			  		<th>Codigo Doctor</th>
			  		<th>Especialidad</th>
			  		<th>Nombres</th>
			  		<th>Apellidos</th>
			  		<th>Email</th>
			  		<th>Telefono</th>
			  		<th></th>
				</tr>
		  	</thead>
		  	<tbody>
			  	<?php foreach($Doctores as $ListDoc) { 
			  		echo '<tr>';
			  		echo '<th scope="row">'.$ListDoc->id.'</th>';
			  		echo '<td>'.$ListDoc->Especialidad.'</td>';
			  		echo '<td>'.$ListDoc->Nombres.'</td>';
			  		echo '<td>'.$ListDoc->Apellidos.'</td>';
			  		echo '<td>'.$ListDoc->Email.'</td>';
			  		echo '<td>'.$ListDoc->Telefono.'</td>';
			  		echo '<td><button href="#" data-toggle="modal" type="button" class="btn btn-default"><span><i class="fa fa-pencil"></i></span></button></td>';
			  		echo '</tr>';
				}?>	
		  	</tbody>
		</table>
	</div>
</div>
<!--Tabla Usuarios end-->

<!--Tabla Usuarios start-->
<div class=" panel-body1">
	<div class="table-responsive">
		<table class="table table-striped">
	 		<thead>
				<tr>
			  		<th>#</th>
			  		<th>Especialidad</th>
			  		<th>Descripción</th>
			  		<th></th>
				</tr>
		  	</thead>
		  	<tbody>
			  	<?php foreach($Especialidades as $ListEsp) { 
			  		echo '<tr>';
			  		echo '<th scope="row">'.$ListEsp->id.'</th>';
			  		echo '<td>'.$ListEsp->Var1.'</td>';
			  		echo '<td>'.$ListEsp->Var2.'</td>';
			  		echo '<td><button href="#" data-toggle="modal" type="button" class="btn btn-default"><span><i class="fa fa-pencil"></i></span></button></td>';
			  		echo '</tr>';
				}?>	
		  	</tbody>
		</table>
	</div>
</div>
<!--Tabla Usuarios end-->