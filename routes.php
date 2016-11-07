<?php
  
  function call($controller, $action) {
    // requiere el archivo que coincide con el nombre de controller
    require_once('controllers/' . $controller . '_controller.php');

    // crea una nueva instancia del controller necesario
    switch($controller) {
      case 'pages':
        require_once('models/pages.php');
        $controller = new PagesController();
      break;
      case 'posts':        
        require_once('models/post.php');
        $controller = new PostsController();
      break;
    }    
    $controller->{ $action }();
  }
  // Lista de controllers que tenemos y los actions respectivos  
  $controllers = array('pages' => ['home', 'error'],
                       'posts' => ['index', 'show']);

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