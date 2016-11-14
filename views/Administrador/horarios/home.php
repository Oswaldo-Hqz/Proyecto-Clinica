<?php 

	if (isset($_POST['EnviarHorario'])) {
		$nombreHorario = trim($_POST['nombreHorario']);
	  	$nombreHorario = strip_tags($nombreHorario);
		$nombreHorario = htmlspecialchars($nombreHorario);
		$HoraInicio = trim($_POST['HoraInicio']);
	  	$HoraInicio = strip_tags($HoraInicio);
		$HoraInicio = htmlspecialchars($HoraInicio);
		$HoraFin = trim($_POST['HoraFin']);
	  	$HoraFin = strip_tags($HoraFin);
		$HoraFin = htmlspecialchars($HoraFin);
		Horarios::ingresarHorario($nombreHorario, $HoraInicio." - ". $HoraFin);

		$errTyp = "success";
		$errMSG = "Registro ingresado con éxito.";	       	
	}
	if (isset($_POST['EnviarTurno'])) {
		$tipohorario = trim($_POST['tipohorario']);
	  	$tipohorario = strip_tags($tipohorario);
		$tipohorario = htmlspecialchars($tipohorario);

		$nombreTurno = trim($_POST['nombreTurno']);
	  	$nombreTurno = strip_tags($nombreTurno);
	  	$nombreTurno = htmlspecialchars($nombreTurno);

	  	if(isset($_POST['lunes'])){$lunes = 1;}
		else{$lunes = 0;}
		if(isset($_POST['martes'])){$martes = 1;}
		else{$martes=0;}
		if(isset($_POST['miercoles'])){$miercoles = 1;}
		else{$miercoles=0;}
		if(isset($_POST['jueves'])){$jueves = 1;}
		else{$jueves=0;}
		if(isset($_POST['viernes'])){$viernes = 1;}
		else{$viernes=0;}
		if(isset($_POST['sabado'])){$sabado = 1;}
		else{$sabado=0;}

		Horarios::ingresarTurno($tipohorario, $nombreTurno, $lunes, $martes, $miercoles, $jueves, $viernes, $sabado);

		$errTyp = "success";
		$errMSG = "Registro ingresado con éxito.";	
	} 

	if (isset($_POST['EditHorario'])) {
		$codigo = trim($_POST['codigo']);
	  	$codigo = strip_tags($codigo);
		$codigo = htmlspecialchars($codigo);
		$nombreHorario = trim($_POST['nombreHorario']);
	  	$nombreHorario = strip_tags($nombreHorario);
		$nombreHorario = htmlspecialchars($nombreHorario);
		$HoraInicio = trim($_POST['HoraInicio']);
	  	$HoraInicio = strip_tags($HoraInicio);
		$HoraInicio = htmlspecialchars($HoraInicio);
		$HoraFin = trim($_POST['HoraFin']);
	  	$HoraFin = strip_tags($HoraFin);
		$HoraFin = htmlspecialchars($HoraFin);
		actualizar::EditHorario($id, $nombreHorario, $HoraInicio." - ". $HoraFin);

		$errTyp = "success";
		$errMSG = "Registro ingresado con éxito.";	       	
	}

	if (isset($_POST['EliminarHorario'])) {

		$codigo = trim($_POST['codigo']);
	  	$codigo = strip_tags($codigo);
		$codigo = htmlspecialchars($codigo);

		$db = Db::getInstance();
      	$result = $db->query("SELECT count(*) FROM turnos WHERE detalleturnoid = '$codigo'");
      	$valor = $result->fetch();
      	$Catidad = $valor[0];
      	if ($Catidad == 0) {
      		actualizar::EliminarHorario($codigo);
      		$errTyp = "success";
			$errMSG = "Registro eliminado con éxito.";
      	} else {
      		$errTyp = "danger";
			$errMSG = "Registro no puede ser eliminado, está asignado a usuario.";
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
	<button href="#ModalCrearHorarios" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-clock-o fa-4x"></i> 
		<br>Crear Horarios</span>
	</button>
	
	<button href="#ModalCrearTurnos" data-toggle="modal" type="button" class="btn btn-default btn-lg">  
		<span><i class="fa fa-calendar-plus-o fa-4x"></i> 
		<br>Crear Turnos</span>
	</button>
</center>

<!-- ************************ MODALS ************************ -->

<!-- MODAL CREAR NUEVO HORARIO -->
<div id="ModalCrearHorarios" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Crear Nuevo Horario</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="" action="?controller=horarios&action=home" enctype="multipart/form-data">
				<div class="modal-body">		
          			<div class="row">		
          			<div class="col-md-1"></div>	
			          	<div class="col-md-10 form-group">
				            <label for="recipient-name" class="control-label">Nombre del horario:</label>
				            <input id="nombreHorario" name="nombreHorario" type="text" class="form-control" id="recipient-name" required>
			          	</div>	
			        </div>	  
			        <div class="row"> 
						<label for="recipient-name" class="control-label">Hora Inicio:</label>
						<div class="form-group input-group bootstrap-timepicker timepicker">							
				            <input id="timepicker1" name="HoraInicio" type="text" class="form-control input-small">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
				        </div>						
			        </div>
					<div class="row"> 
						<label for="recipient-name" class="control-label">Hora Fin:</label>
						<div class="col-md-2 form-group input-group bootstrap-timepicker timepicker">							
				            <input id="timepicker2" name="HoraFin" type="text" class="form-control input-small">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
				        </div>						
			        </div>
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarHorario" id="EnviarHorario" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL CREAR NUEVO HORARIO -->

<!-- MODAL CREAR NUEVO TURNO -->
<div id="ModalCrearTurnos" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 id="myModalLabel">Crear Nuevo Turno</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="" action="?controller=horarios&action=home" enctype="multipart/form-data">
				<div class="modal-body">		
          			<div class="col-md-6 form-group">
			            <label for="recipient-name" class="control-label">Turno:</label>
			            <select id="tipohorario" name="tipohorario" class="selectpicker show-tick form-control">
			            <?php foreach($TableHorario as $ListHora) { 
			            	echo '<option value="'.$ListHora->id.'">'.$ListHora->Nombre.'</option>';
		            	}?>		          	
				        </select>
		          	</div> 	
		          	<div class="col-md-6 form-group">
			            <label for="recipient-name" class="control-label">Nombre del turno:</label>
			            <input id="nombreTurno" name="nombreTurno" type="text" class="form-control" id="recipient-name" required>
		          	</div>	   
			        <div class="row">      
			          	<div class="col-md-2 form-group">
				            <label for="recipient-name" class="control-label">Lunes:</label><br>
							<input type="checkbox" id="lunes" name="lunes" checked>				            
			          	</div>		
			          	<div class="col-md-2 form-group">
				            <label for="recipient-name" class="control-label">Martes:</label><br>
							<input type="checkbox" id="martes" name="martes" checked>				            
			          	</div>		          		
			          	<div class="col-md-2 form-group">
				            <label for="recipient-name" class="control-label">Miercoles:</label><br>
							<input type="checkbox" id="miercoles" name="miercoles" checked>				            
			          	</div>
			          	<div class="col-md-2 form-group">
				            <label for="recipient-name" class="control-label">Jueves:</label><br>
							<input type="checkbox" id="jueves" name="jueves" checked>				            
			          	</div>
			          	<div class="col-md-2 form-group">
				            <label for="recipient-name" class="control-label">Viernes:</label><br>
							<input type="checkbox" id="viernes" name="viernes" checked>				            
			          	</div>
			          	<div class="col-md-2 form-group">
				            <label for="recipient-name" class="control-label">Sabado:</label><br>
							<input type="checkbox" id="sabado" name="sabado" checked>				            
			          	</div>			          	
					</div>					
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EnviarTurno" id="EnviarTurno" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL CREAR NUEVO TURNO -->


<!-- MODAL EDIT NUEVO HORARIO -->
<div id="ModalEditHorario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="text-center" id="myModalLabel">Editar Horario</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="" action="?controller=horarios&action=home" enctype="multipart/form-data">
				<div class="modal-body">		
          			<div class="row">		
          			<div class="form-group">
			            <input id="codigo" name="codigo" type="hidden" class="form-control" required>
		          	</div>
          			<div class="col-md-1"></div>	
			          	<div class="col-md-10 form-group">
				            <label for="recipient-name" class="control-label">Nombre del horario:</label>
				            <input id="nombreHorario" name="nombreHorario" type="text" class="form-control" id="recipient-name" required>
			          	</div>	
			        </div>	  
			        <div class="row"> 
						<label for="recipient-name" class="control-label">Hora Inicio:</label>
						<div class="form-group input-group bootstrap-timepicker timepicker">							
				            <input id="EditTimepicker1" name="HoraInicio" type="text" class="form-control input-small">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
				        </div>						
			        </div>
					<div class="row"> 
						<label for="recipient-name" class="control-label">Hora Fin:</label>
						<div class="col-md-2 form-group input-group bootstrap-timepicker timepicker">							
				            <input id="EditTimepicker2" name="HoraFin" type="text" class="form-control input-small">
				            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
				        </div>						
			        </div>
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">Cerrar</button>					
					<input name="EditHorario" id="EditHorario" type="submit" class="btn btn-primary" value="Aceptar">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL EDIT NUEVO HORARIO -->

<!-- MODAL DELETE NUEVO HORARIO -->
<div id="ModalEliminarHorario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h3 class="text-center" id="myModalLabel">Eliminar Horario</h3>
			</div>
			<form id="FormNuevoUsuario" method="post" onsubmit="" action="?controller=horarios&action=home" enctype="multipart/form-data">
				<div class="modal-body">		
          			<div class="row">
          			<div class="form-group">
			            <input id="codigo" name="codigo" type="hidden" class="form-control" required>
		          	</div>			
          			<div class="col-md-1"></div>	
			          	<div class="col-md-10 form-group">
				            <label for="recipient-name" class="control-label text-center text-danger">¿Realmente desea eliminar este horario del registro? </label>				            
			          	</div>	
			        </div>	  			        
				</div>
				<div id="MensajeFormularioUsuario"></div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">No</button>					
					<input name="EliminarHorario" id="EliminarHorario" type="submit" class="btn btn-primary" value="Si">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- END MODAL DELETE NUEVO HORARIO -->

<!-- ************************ TABLES ************************ -->

<!--Tabla Horarios start-->
<div class="col-md-12">
	<div class=" panel-body1">
		<div class="table-responsive">
			<table class="table table-striped">
			 	<thead>
					<tr>
						<th>#</th>
				  		<th>Nombre Horario</th>
				  		<th>Horario</th>
				  		<th></th>
					</tr>
			  	</thead>
			  	<tbody>
				  	<?php foreach($TableHorario as $ListHorarios) { 
				  		echo '<tr>';
				  		echo '<th scope="row">'.$ListHorarios->id.'</th>';
				  		echo '<td>'.$ListHorarios->Nombre.'</td>';
				  		echo '<td>'.$ListHorarios->Horario.'</td>';
				  		echo '<td>
				  		<button type="button" class="btn btn-default" data-toggle="modal"  data-target="#ModalEditHorario" data-id="'.$ListHorarios->id.'" data-nombre="'.$ListHorarios->Nombre.'"><span><i class="fa fa-pencil"></i></span></button>
				  		<button type="button" class="btn btn-default" data-toggle="modal"  data-target="#ModalEliminarHorario" data-id="'.$ListHorarios->id.'" ><span><i class="fa fa-trash"></i><br></span></button>
				  		</td>';
				  		echo '</tr>';
					}?>	
			  	</tbody>
			</table>
		</div>
	</div>
</div>
<!--Tabla Horarios end-->

<!--Tabla Turnos start-->
<div class="col-md-12">
	<div class=" panel-body1">
		<div class="table-responsive">
			<table class="table table-striped">
			 	<thead>
					<tr>
						<th>#</th>
				  		<th>Nombre Turno</th>
				  		<th>Tipo Horario</th>
				  		<th>Lunes</th>
				  		<th>Martes</th>
				  		<th>Miercoles</th>
				  		<th>Jueves</th>
				  		<th>Viernes</th>
				  		<th>Sabado</th>
				  		<th></th>
					</tr>
			  	</thead>
			  	<tbody>
				  	<?php foreach($TableTurnos as $ListTurnos) { 
				  		echo '<tr>';
				  		echo '<th scope="row">'.$ListTurnos->id.'</th>';
				  		echo '<td>'.$ListTurnos->Nombre.'</td>';
				  		echo '<td>'.$ListTurnos->nombreHorario.'</td>';
				  		if ($ListTurnos->L == '1') {echo '<td><span><center><i class="fa fa-calendar-check-o fa-2x"></i></center></span></td>';} else {echo '<td><span><center><i class="fa fa-calendar-o fa-2x"></i></center></span></td>';}
				  		if ($ListTurnos->M == '1') {echo '<td><span><center><i class="fa fa-calendar-check-o fa-2x"></i></center></span></td>';} else {echo '<td><span><center><i class="fa fa-calendar-o fa-2x"></i></center></span></td>';}
				  		if ($ListTurnos->X == '1') {echo '<td><span><center><i class="fa fa-calendar-check-o fa-2x"></i></center></span></td>';} else {echo '<td><span><center><i class="fa fa-calendar-o fa-2x"></i></center></span></td>';}
				  		if ($ListTurnos->J == '1') {echo '<td><span><center><i class="fa fa-calendar-check-o fa-2x"></i></center></span></td>';} else {echo '<td><span><center><i class="fa fa-calendar-o fa-2x"></i></center></span></td>';}
				  		if ($ListTurnos->V == '1') {echo '<td><span><center><i class="fa fa-calendar-check-o fa-2x"></i></center></span></td>';} else {echo '<td><span><center><i class="fa fa-calendar-o fa-2x"></i></center></span></td>';}
				  		if ($ListTurnos->S == '1') {echo '<td><span><center><i class="fa fa-calendar-check-o fa-2x"></i></center></span></td>';} else {echo '<td><span><center><i class="fa fa-calendar-o fa-2x"></i></center></span></td>';}
				  		echo '<td>
				  		<button href="#" data-toggle="modal" type="button" class="btn btn-default"><span><i class="fa fa-pencil"></i></span></button>
				  		<button type="button" class="btn btn-default" data-toggle="modal"  data-target="#ModalEliminarTipoU" data-id="" ><span><i class="fa fa-trash"></i><br></span></button>
				  		</td>';
				  		echo '</tr>';
					}?>	
			  	</tbody>
			</table>
		</div>
	</div>
</div>
<!--Tabla Turnos end-->