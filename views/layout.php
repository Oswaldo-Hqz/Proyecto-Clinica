

<!DOCTYPE HTML>
<html>
<head>
  <title>Clinica Buena Salud</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="" />
  <script src="js/jquery-1.10.2.min.js"></script>
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } 
  </script>
   
  <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
  <link href="css/style.css" rel='stylesheet' type='text/css' />
  <link href="css/font-awesome.css" rel="stylesheet"> 
  <link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
  <script src="js/Chart.js"></script>
  <link href="css/animate.css" rel="stylesheet" type="text/css" media="all">
  <link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/bootstrap-select.min.css">
  <link href="css/bootstrap-switch.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css" rel="stylesheet">
  
  <script src="js/wow.min.js"></script>
  <script src="js/validacion.js"></script>
  <script>
     new WOW().init();
  </script>
  <script src="js/bootstrap-select.min.js"></script>

</head> 

<body class="sticky-header left-side-collapsed"  onload="initMap()">  
  <section>
  <!-- left side start-->
    <div class="left-side sticky-left-side">

      <!--logo and iconic logo start-->
      <div class="logo">
        <img href="home" src="img/logo_mini.png" alt="Logo">        
      </div>
      <div class="logo-icon text-center">
        <a href="home"><i class="lnr lnr-home"></i> </a>
      </div>
      <!--logo and iconic logo end-->

      <div class="left-side-inner">
        <!--sidebar nav start-->
          <ul class="nav nav-pills nav-stacked custom-nav">
          <?php if ($_SESSION['Tipo'] == 'Administrador') {
           ?>

            <li><a href="?controller=usuarios&action=home"><i class="fa fa-user-circle"></i><span>Usuarios</span></a></li>
            <li><a href="?controller=horarios&action=home"><i class="fa fa-clock-o"></i><span>Horarios y Turnos</span></a></li>
            <li><a href="?controller=doctores&action=home"><i class="fa fa-user-md"></i> <span>Medicos</span></a></li>      
            <li><a href="#"><i class="fa fa-address-card"></i> <span>Pacientes</span></a></li>
            <li><a href="#"><i class="fa fa-address-book"></i> <span>Historial Consultas</span></a></li>            

          <?php  
          } if ($_SESSION['Tipo'] == 'Doctor') {          
          ?>
            <li><a href="index.php"><i class="fa fa-user-circle"></i><span>Usuarios</span></a></li>
            <li><a href="#"><i class="fa fa-clock-o"></i><span>Horarios</span></a></li>
          <?php } ?>

          </ul>
        <!--sidebar nav end-->
      </div>
    </div>    
    <!-- left side end-->

    <div class="main-content">

      <!-- header-starts -->
      <div class="header-section">       
        <!--toggle button start-->
        <a class="toggle-btn  menu-collapsed"><i class="fa fa-bars"></i></a>
        <!--toggle button end-->
        <!--notification menu start -->
        <div class="menu-right">
          <div class="user-panel-top">    
            <div class="profile_details_left">              
            </div>

            <div class="profile_details">   
              <ul>
                <li class="dropdown profile_details_drop">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <div class="profile_img"> 
                    <?php echo '<span style="background:url(data:image/jpeg;base64,'.base64_encode( $_SESSION['foto'] ).') no-repeat center"> </span> '; ?>
                       <div class="user-name">
                        <p><?php echo $_SESSION['Nombre'];?><span><?php echo $_SESSION['Tipo'];?></span></p>
                       </div>
                       <i class="lnr lnr-chevron-down"></i>
                       <i class="lnr lnr-chevron-up"></i>
                      <div class="clearfix"></div>  
                    </div>  
                  </a>
                  <ul class="dropdown-menu drp-mnu">
                    <!--<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
                    <li> <a href="#"><i class="fa fa-user"></i>Profile</a> </li> -->
                    <li> <a href='logout.php?logout'><i class="fa fa-sign-out"></i> Salir</a> </li>
                  </ul>
                </li>
                <div class="clearfix"> </div>
              </ul>
            </div>                            
            <div class="clearfix"></div>
          </div>
        </div>
        <!--notification menu end -->
      </div>
       <!-- header-End -->

      <div id="page-wrapper">

            <!--<a href='/clinic/home'>Home</a>
            <a href='?controller=posts&action=index'>Posts</a>
            <a href='logout.php?logout'>Salir</a>-->

            <?php require_once('routes.php'); ?>  

      </div>
    </div>

    <!--footer section start-->
      <footer>
         <p>&copy 2016 Clinica Buena Salud. All Rights Reserved | Design by <a href="https://github.com/Oswaldo-Hqz" target="_blank">Oswaldo Hqz</a> & <a href="" target="_blank">Milton López</a></p>
      </footer>
        <!--footer section end-->
  </section>
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery.nicescroll.js"></script>
  <script src="js/scripts.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/bootstrap-switch.js"></script>MyScripts
   <script src="js/MyScripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>  
  <script type="text/javascript">$('#timepicker1').timepicker();$('#timepicker2').timepicker();</script>
  
</body>
</html>