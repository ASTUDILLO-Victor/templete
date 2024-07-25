<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aire</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"> </script>
    <script src="js/validar.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/notificacion.js"></script>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script  src="js/modal.js"></script>
    
    <style>
        .hola{
            display: flex;
            justify-content: space-between;
        }
       
        .collapse-item {
            display: block;
            width: 100%;
            box-sizing: border-box; 
            padding: 10px;
            font-size: 10.5px; /* Ajusta el tamaño de la fuente según sea necesario */
            white-space: normal; /* Permite que el texto se rompa en varias líneas */
            overflow-wrap: break-word; /* Asegura que el texto largo se divida y no sobresalga */
        }
        

        #toast-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 1050;
        }

        .toast {
            min-width: 300px;
        }

        .toast-body p {
            margin: 0;
        }
</style>


</head>

<body id="page-top">
    

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?url=templete">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                    
                </div>
                <div class="sidebar-brand-text mx-3"><span class="text-white text-end"><?=$_SESSION['name']?></span> <sup></sup></div>
            </a>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php?url=templete">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interfaz
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <?php if ( isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 1 ): ?>
                
                <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ADMINISTRACIÓN</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">TABLAS DE USUARIOS:</h6>
                        <a class="collapse-item" href="index.php?url=tables">USUARIOS</a>
                        <a class="collapse-item" href="index.php?url=tables2">DESACTIVADOS</a>
                        
                        
                        
                    </div>
                </div>
            </li>
            <?php endif ?>
            <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 2): ?>
                
                <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities1"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>ADMINISTRACIÓN</span>
                </a>
                <div id="collapseUtilities1" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">TABLAS DE USUARIOS:</h6>
                        <a class="collapse-item" href="index.php?url=tables3">USUARIOS</a>
                        <a class="collapse-item" href="index.php?url=tables4">DESACTIVADOS</a>
                        
                    </div>
                </div>
            </li>
            <?php endif ?>

            <?php if (isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == 3): ?>
                <!-- Código específico para usuarios -->
            <?php endif ?>
            
            
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>MONITOREO</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Concentraciones:</h6>
                        <a class="collapse-item"  href="index.php?url=grafico">Partículas Suspendidas en el Aire</a>
                        
                        <a class="collapse-item" href="index.php?url=grafico2">Compuestos Orgánicos Vólatiles</a>

                        
                    </div>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities2"
                aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-clipboard"></i>
                    <span>REPORTES</span></a>
                    <div id="collapseUtilities2" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Concentraciones:</h6>
                        <a class="collapse-item" href="index.php?url=reporte">Reporte</a>                        
                        <a class="collapse-item" href="index.php?url=reporte_uno">Partículas Suspendidas en el Aire</a>
                        <a class="collapse-item" href="index.php?url=reporte2">Compuestos Orgánicos Vólatiles</a>

                    </div>
                </div>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="" data-toggle="collapse" data-target="#collapseUtilities3"
                aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-table"></i>
                    <span>MÁQUINA</span></a>
                    <div id="collapseUtilities3" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Concentraciones:</h6>
                        <a class="collapse-item" href="index.php?url=purificadora">Purificadora</a>
                        <a class="collapse-item" href="index.php?url=mitigadora">Mitigadora</a>

                    </div>
                </div>
            </li> -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?url=purificadora">
                    <i class="fas fa-toggle-off"></i>
                    <span>MÁQUINA</span></a>
            </li>

        
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Salir
            </div>
            <li class="nav-item text-center"> 
            <?php if(Core\Auth::check()): ?>
                <form style="display:inline" action="index.php?url=logout" method="POST">
                    <button class="btn btn-danger">salir</button>
                </form>
            <?php endif ?>
            </li>
            <br>

            <!-- Nav Item - Pages Collapse Menu -->


            <!-- Nav Item - Charts -->


            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>



        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search 
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>-->
                    <h1 class="m-0 font-weight-bold text-info">AireSafe </h1>
                    
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->

                        <!-- Nav Item - Messages -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <div id="toast-container" aria-live="polite" aria-atomic="true" class="d-flex justify-content-end">
                            <!-- Toasts will be appended here dynamically -->
                        </div>

                        <div id="toast-template" style="display: none;">
                            <div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="5000">
                                <div class="toast-header">
                                    <strong class="mr-auto">Notificación</strong>
                                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="toast-body">
                                    <p class="toast-status"></p>
                                    <p class="toast-description"></p>
                                    <p class="toast-timestamp"></p>
                                </div>
                            </div>
                        </div>

                                            

                    </ul>

                </nav>
                <!-- End of Topbar -->