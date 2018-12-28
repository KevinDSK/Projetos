<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Icone -->
        <!-- Preciso colocar ainda  -->
        <link rel="icon" type="image/png" sizes="16x16" href="view/imagens/icon.ico">
        
        <title>Lista de Academias</title>
        
        <!-- CSS -->
        <link href="view/css/float-chart.css" rel="stylesheet">
        <link href="view/css/style.min.css" rel="stylesheet">
        <link href="view/css/dataTables.bootstrap4.css" rel="stylesheet">
        
    </head>

    <body>

        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>

        <div id="main-wrapper">

            <!-- Topbar header - style you can find in pages.scss -->
            <!-- Topbar header - style you can find in pages.scss -->
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin5">

                        <!-- This is for the sidebar toggle which is visible on mobile only -->
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>

                        <!-- Logo -->
                        <a class="navbar-brand" href="index.php">

                            <!-- Logo icon -->
                            <b class="logo-icon p-l-10">
                                <!-- Dark Logo icon -->
                                <img src="view/imagens/fpj.png" alt="homepage" class="light-logo">
                            </b>
                            <!--End Logo icon -->

                        </a>
                        <!-- End Logo -->

                    </div>

                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                        
                        <ul class="navbar-nav float-left mr-auto"></ul>
                        
                        <!-- Right side toggle and nav items -->
                        <ul class="navbar-nav float-right">
                            <li class="nav-item dropdown">
                                <a class="nav-link waves-effect waves-dark" href="noticia.php">
                                    <b class="font-17">Notícias</b>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link waves-effect waves-dark" href="listaAcademia.php">
                                    <b class="font-17">Lista de Academias</b>
                                </a>
                            </li>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <a href="login.php" class="btn btn-success"><i class="mdi mdi-login font-17"></i>Login</a>
                                </a>
                            </li>

                        </ul>
                    </div>
                </nav>
            </header>
            <!-- End Topbar header -->
            
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Sales Cards  -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title">Lista de academias: </h3>
                                <div class="table-responsive">

                                    <?php
                                        include_once "model/Academia.php";

                                        $academia = new Academia();
                                        echo $academia->listaAcademiaPublico();
                                    ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container fluid  -->
        </div>
        
        <!-- All Jquery -->
        <script src="view/js/jquery.min.js"></script>
        
        <!-- Bootstrap tether Core JavaScript -->
        <script src="view/js/popper.min.js"></script>
        <script src="view/js/bootstrap.min.js"></script>
        <script src="view/js/perfect-scrollbar.jquery.min.js"></script>
        <script src="view/js/sparkline.js"></script>
        
        <!--Wave Effects -->
        <script src="view/js/waves.js"></script>
        
        <!--Menu sidebar -->
        <script src="view/js/sidebarmenu.js"></script>
        
        <!--Custom JavaScript -->
        <script src="view/js/custom.min.js"></script>
            
        <!-- Charts js Files -->
        <script src="view/js/excanvas.js"></script>
        <script src="view/js/jquery.flot.js"></script>
        <script src="view/js/jquery.flot.pie.js"></script>
        <script src="view/js/jquery.flot.time.js"></script>
        <script src="view/js/jquery.flot.stack.js"></script>
        <script src="view/js/jquery.flot.crosshair.js"></script>
        <script src="view/js/jquery.flot.tooltip.min.js"></script>
        <script src="view/js/chart-page-init.js"></script>
        <script src="view/js/datatables.min.js"></script>
        
        <script>
            /* Basic Table */
            $('#zero_config').DataTable();
        </script>
    </body>
</html>