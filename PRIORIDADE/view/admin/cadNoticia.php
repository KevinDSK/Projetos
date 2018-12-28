<?php
    session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Icone -->
        <link rel="icon" type="image/png" sizes="16x16" href="../imagens/icon.ico">
        
        <title>Cadastrar Notícia</title>
        
        <!-- CSS -->
        <link href="../css/float-chart.css" rel="stylesheet">
        <link href="../css/style.min.css" rel="stylesheet">
        
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

                        <!-- Toggle which is visible on mobile only -->
                        <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">

                        <!-- Guarda Menu Lateral -->
                        <ul class="navbar-nav float-left mr-auto">
                            <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                        </ul>

                        <!-- Right side toggle and nav items -->
                        <ul class="navbar-nav float-right">

                            <!-- Perfil de Usuário -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="../imagens/d1.jpg" alt="Administrador" class="rounded-circle" width="31">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right user-dd animated">
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
            
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <aside class="left-sidebar" data-sidebarbg="skin5">
                
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav" class="p-t-30">
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="index.php" aria-expanded="false">
                                    <i class="fas fa-home"></i>
                                    <span class="hide-menu">Home</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="noticia.php" aria-expanded="false">
                                    <i class="far fa-bell"></i>
                                    <span class="hide-menu">Notícias</span>
                                </a>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link waves-effect waves-dark sidebar-link" href="calendario.php" aria-expanded="false">
                                    <i class="far fa-calendar-alt"></i>
                                    <span class="hide-menu">Calendário de Campeonatos</span>
                                </a>
                            </li>
                            <li class="sidebar-item enabled">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="far fa-clipboard"></i>
                                    <span class="hide-menu">Academia</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item">
                                        <a href="cadAcademia.php" class="sidebar-link">
                                            <i class="fas fa-plus"></i>
                                            <span class="hide-menu">Cadastrar Academia</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="listaAcademia.php" class="sidebar-link">
                                            <i class="fas fa-list"></i>
                                            <span class="hide-menu">Lista de Academias</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item">
                                <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false">
                                    <i class="far fa-clipboard"></i>
                                    <span class="hide-menu">Delegacia</span>
                                </a>
                                <ul aria-expanded="false" class="collapse  first-level">
                                    <li class="sidebar-item">
                                        <a href="cadDelegacia.php" class="sidebar-link">
                                            <i class="fas fa-plus"></i>
                                            <span class="hide-menu">Cadastrar Delegacia</span>
                                        </a>
                                    </li>
                                    <li class="sidebar-item">
                                        <a href="listaDelegacia.php" class="sidebar-link">
                                            <i class="fas fa-list"></i>
                                            <span class="hide-menu">Lista de Delegacias</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- End Sidebar navigation -->
                    
                </div>
                <!-- End Sidebar scroll-->
                
            </aside>
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            
            <!-- Page wrapper  -->
            <div class="page-wrapper">
                
                <!-- Bread crumb and right sidebar toggle -->
                 <div class="page-breadcrumb">
                    <div class="row">
                        <div class="col-12 d-flex no-block align-items-center">
                            <h4 class="page-title">Cadastrar Notícia</h4>
                            <div class="ml-auto text-right">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.php">Home</a>
                                        </li>
                                        <li class="breadcrumb-item">
                                            <a href="noticia.php">Notícias</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">Cadastrar Notícia</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                
                <!-- Container fluid  -->
                <div class="container-fluid">
                    
                    <!-- Sales Cards  -->
                    <div class="row">
                        
                        <!-- Column -->
                        <div class="col-md-6 col-lg-4 col-xlg-3">
                            <a href="noticia.php" class="card card-hover">
                                <div class="box bg-success text-center">
                                    <h1 class="font-light text-white">
                                        <i class="far fa-clipboard"></i>
                                    </h1>
                                    <h6 class="text-white">Notícias</h6>
                                </div>
                            </a>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md">
                            
                            <?php
                                if(isset($_SESSION['mensagemCadNoticia'])){
                                    echo $_SESSION['mensagemCadNoticia'];
                                    unset($_SESSION['mensagemCadNoticia']);
                                }
                            ?>
                            
                            <div class="card">
                                <form class="form-horizontal" action="../../controller/sistemaAdm.php?op=7" method="post" enctype="multipart/form-data">
                                    <div class="card-body">
                                        <h4 class="card-title">Cadastrar Notícia</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Título da Notícia :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Título" name="titulo" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Descrição</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="5" name="descricao"></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Escolha uma Imagem :</label>
                                            <div class="col-sm-9">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" required name="nomeImagem">
                                                    <label class="custom-file-label">Escolha uma imagem</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="border-top">
                                        <div class="card-body" align="right">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-plus"></i>
                                                Cadastrar
                                            </button>
                                            <a href="noticia.php" class="btn btn-warning">
                                                <i class="fas fa-angle-left"></i>
                                                Cancelar
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- End ROW  -->
                    </div>
                </div>
            </div>
        </div>
        <!-- End Wrapper -->
        
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
        
    </body>
</html>