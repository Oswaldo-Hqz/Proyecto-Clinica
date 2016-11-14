<?php
  
  function call($controller, $action) {
    // requiere el archivo que coincide con el nombre de controller
    require_once('controllers/' . $controller . '_controller.php');

    if ($_SESSION['Tipo'] == 'Administrador') {
      // crea una nueva instancia del controller necesario
      switch($controller) {
        case 'pages':
          require_once('models/pages.php');
          $controller = new PagesController();
        break;
        case 'usuarios':
          require_once('models/usuarios.php');
          $controller = new UsuariosController();
        break;
        case 'horarios':
          require_once('models/horarios.php');
          $controller = new HorariosController();
        break;
        case 'doctores':
          require_once('models/doctores.php');
          $controller = new DoctoresController();
        break;
        case 'posts':        
          require_once('models/post.php');
          $controller = new PostsController();
        break;
      }                
    }      
    if ($_SESSION['Tipo'] == 'Doctor') {
      // crea una nueva instancia del controller necesario
      switch($controller) {
        case 'doctor':
          require_once('models/doctor.php');
          $controller = new DoctorController();
        break;        
      }                
    }

    if ($_SESSION['Tipo'] == 'Asistente') {
      // crea una nueva instancia del controller necesario
      switch($controller) {
        case 'asistente':
          require_once('models/asistente.php');
          $controller = new AsistenteController();
        break;        
      }                
    } 

    $controller->{ $action }();
  }
  // Lista de controllers que tenemos y los actions respectivos  
  $controllers = array('pages' => ['home', 'error'],
                       'usuarios' => ['home', 'error'],
                       'horarios' => ['home', 'error'],
                       'doctores' => ['home', 'error'],
                       'posts' => ['index', 'show'],

                       'asistente' => ['home', 'error'],

                       'doctor' => ['home', 'show'],
                       );

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {

    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('pages', 'error');
    }

  } else {
    call('pages', 'error');
  }
?>