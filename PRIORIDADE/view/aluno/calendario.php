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
        <link rel="icon" type="image/png" sizes="16x16" href="../imagens/icon.ico">
        
        <title>Calendário</title>
        
        <!-- CSS -->
        <link href="../css/float-chart.css" rel="stylesheet">
        <link href="../css/fullcalendar.min.css" rel="stylesheet">
        <link href="../css/calendar.css" rel="stylesheet">
        <link href="../css/style.min.css" rel="stylesheet">
        
        <!-- All Jquery -->
        <script src="../js/jquery.min.js"></script>
        
        <!-- Bootstrap tether Core JavaScript -->
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/perfect-scrollbar.jquery.min.js"></script>
        <script src="../js/sparkline.js"></script>
        
        <!--Wave Effects -->
        <script src="../js/waves.js"></script>
        
        <!--Menu sidebar -->
        <script src="../js/sidebarmenu.js"></script>
        
        <!--Custom JavaScript -->
        <script src="../js/custom.min.js"></script>
            
        <!-- Charts js Files -->
        <script src="../js/excanvas.js"></script>
        <script src="../js/jquery.flot.js"></script>
        <script src="../js/jquery.flot.pie.js"></script>
        <script src="../js/jquery.flot.time.js"></script>
        <script src="../js/jquery.flot.stack.js"></script>
        <script src="../js/jquery.flot.crosshair.js"></script>
        <script src="../js/jquery.flot.tooltip.min.js"></script>
        <script src="../js/chart-page-init.js"></script>
        
        <script src="../js/moment.min.js"></script>
        <script src="../js/fullcalendar.min.js"></script>
        
        <script>
			<?php
                
                include_once "../../model/Evento.php";

                $evento = new Evento();
                echo $evento->exibirEvento($_SESSION['iddelegacia']);
            ?>
            
		</script>
        
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
                                <img src="../imagens/fpj.png" alt="homepage" class="light-logo">
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
                                <a class="nav-link waves-effect waves-dark" href="calendario.php">
                                    <b class="font-17">Calendário de Campeonatos</b>
                                </a>
                            </li>

                            <!-- Perfil de Usuário -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../imagens/d3.jpg" alt="Aluno" class="rounded-circle" width="31">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right user-dd animated">
                                    <a class="dropdown-item" href="perfil.php">
                                        <i class="ti-user m-r-5 m-l-5"></i> Perfil
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../../controller/sistemaAdm.php?op=11">
                                        <i class="fa fa-power-off m-r-5 m-l-5"></i> Logout
                                    </a>
                                </div>
                            </li>
                            <!--  End do Perfil de Usuário -->

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
                        <br>
                        <h3 class="page-title">Calendário de Campeonatos :</h3>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="evento"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Container fluid  -->
        </div>
        
        <!-- Modal Add Category -->
        <div class="modal fade none-border" id="detalhe">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Detalhe do Campeonato</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <dl class="dl-horizontal">
                            <dt>Nome do Evento: </dt>
                            <dd id="nomeCampeonato"></dd>
                            <dt>Dia do Evento:</dt>
                            <dd id="data"></dd>
                            <dt>Tipo do Evento:</dt>
                            <dd id="tipoCampeonato"></dd>
                            <dt>Local do Evento:</dt>
                            <dd id="local"></dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MODAL -->
    </body>
</html>