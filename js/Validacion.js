function validarNuevoUsuario(Formulario) {

  if (!(/^[A-Z]{3}\d{3}$/.test(Formulario.codigo.value))) {
  	document.getElementById('MensajeFormularioUsuario').innerHTML = '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>El código ingresado no es valido</div>';
    return false;
  }
  if (!(/^[-a-zA-Z\s]+$/.test(Formulario.nombres.value))) {
    document.getElementById('MensajeFormularioUsuario').innerHTML = '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>El nombre ingresado no es valido</div>';
    return false;
  }
  if (!(/^[-a-zA-Z\s]+$/.test(Formulario.apellidos.value))) {
  	document.getElementById('MensajeFormularioUsuario').innerHTML = '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>El apellido ingresado no es valido</div>';
    return false;
  }  
  if (!(/^\d{4}-\d{4}$/.test(Formulario.telefono.value))) {
    document.getElementById('MensajeFormularioUsuario').innerHTML = '<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert">×</button><strong>El numero de telefono ingresado no es valido</div>';
    return false;
  }  
  return true;
}