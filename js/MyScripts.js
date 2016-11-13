$("[name='lunes']").bootstrapSwitch();
$("[name='martes']").bootstrapSwitch();
$("[name='miercoles']").bootstrapSwitch();
$("[name='jueves']").bootstrapSwitch();
$("[name='viernes']").bootstrapSwitch();
$("[name='sabado']").bootstrapSwitch();


$('#ModalModificarUsuario').on('show.bs.modal', function (event) {

  	var button = $(event.relatedTarget)
  	var id = button.data('id') 
  	var nombre = button.data('nombre') 
  	var apellido = button.data('apellido') 
	var email = button.data('email') 
	var telefono = button.data('telefono') 
	var direccion = button.data('direccion') 
	var turno = button.data('turnoid') 
  	//var modal = $(this)
  	//modal.find('#myModalLabel').text('Modificar Usuario: ' + id)
  	//modal.find('.modal-body input').val(recipient)
  	$(event.currentTarget).find('#myModalLabel').text('Modificar Usuario: ' + id);
  	$(event.currentTarget).find('input[name="codigo"]').val(id);
  	$(event.currentTarget).find('input[name="nombres"]').val(nombre);
  	$(event.currentTarget).find('input[name="apellidos"]').val(apellido);
  	$(event.currentTarget).find('input[name="email"]').val(email);
  	$(event.currentTarget).find('input[name="telefono"]').val(telefono);
  	$(event.currentTarget).find('input[name="direccion"]').val(direccion);
  	$(event.currentTarget).find('.turnos').val(turno);
})	

$('#ModalModificarPass').on('show.bs.modal', function (event) {
  	var button = $(event.relatedTarget)
  	var id = button.data('id') 
  	$(event.currentTarget).find('input[name="codigo"]').val(id);
})	

$('#ModalModificarTipoU').on('show.bs.modal', function (event) {
  	var button = $(event.relatedTarget)
  	var id = button.data('id') 
  	var nombre = button.data('nombre') 
  	$(event.currentTarget).find('input[name="codigo"]').val(id);
  	$(event.currentTarget).find('input[name="nombreTipo"]').val(nombre);
})

$('#ModalEliminarTipoU').on('show.bs.modal', function (event) {
  	var button = $(event.relatedTarget)
  	var id = button.data('id') 
  	$(event.currentTarget).find('input[name="codigo"]').val(id);
})	