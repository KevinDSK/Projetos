<?php
    session_start();
?>

<!DOCTYPE html>
<html dir="ltr">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon icon -->
        <link rel="icon" type="image/png" sizes="16x16" href="view/imagens/icon.ico">
        <title>Login</title>
        <!-- Custom CSS -->
        <link href="view/css/style.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="main-wrapper">

            <!-- Preloader - style you can find in spinners.css -->
            <div class="preloader">
                <div class="lds-ripple">
                    <div class="lds-pos"></div>
                    <div class="lds-pos"></div>
                </div>
            </div>
            <!-- Preloader - style you can find in spinners.css -->

            <!-- Login box.scss -->
            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
                <div class="auth-box bg-dark border-top border-secondary">
                    <div class="text-center p-t-20 p-b-20">
                        <span class="db">
                            <img src="view/imagens/logoLogin.png">
                        </span>
                    </div>
                    
                    <!-- Form -->
                    <form class="form-horizontal m-t-20" action="controller/sistemaPublico.php?op=1" method="post">
                        <div class="row p-b-30">
                            <div class="col-12">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white">
                                            <i class="ti-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" name="usuario" class="form-control form-control-lg" placeholder="Usuário" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white">
                                            <i class="ti-pencil"></i>
                                        </span>
                                    </div>
                                    <input type="password" name="senha" class="form-control form-control-lg" placeholder="Senha" required>
                                </div>
                            </div>
                        </div>
                        
                        <?php
                            if(isset($_SESSION['mensagemLogin'])){
                                echo $_SESSION['mensagemLogin'];
                                unset($_SESSION['mensagemLogin']);
                            }
                        ?>
                        
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="p-t-20">
                                        <a href="index.php" class="btn btn-warning">
                                            <i class="fas fa-angle-left"></i>
                                            Voltar
                                        </a>
                                        <button class="btn btn-success float-right" type="submit">
                                            <i class="mdi mdi-login font-17"></i>
                                            Entrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Login box.scss -->

            <!-- Page wrapper scss in scafholding.scss -->

            <!-- Page wrapper scss in scafholding.scss -->

            <!-- Right Sidebar -->

            <!-- Right Sidebar -->

        </div>

        <!-- All Required js -->
        <script src="view/js/jquery.min.js"></script>

        <!-- Bootstrap tether Core JavaScript -->
        <script src="view/js/popper.min.js"></script>
        <script src="view/js/bootstrap.min.js"></script>
        
        <script>

            $('[data-toggle="tooltip"]').tooltip();
            $(".preloader").fadeOut();
            
            // Login and Recover Password 
            $('#to-recover').on("click", function() {
                $("#loginform").slideUp();
                $("#recoverform").fadeIn();
            });
            $('#to-login').click(function(){

                $("#recoverform").hide();
                $("#loginform").fadeIn();
            });
        </script>
        
    </body>
</html>