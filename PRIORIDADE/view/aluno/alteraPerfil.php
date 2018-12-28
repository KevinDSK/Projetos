<?php
    session_start();

    include_once "../../model/Conexao.php";
    
    $conexao = new Conexao();

    $con = $conexao->conectar();

    $sql = "SELECT * FROM Aluno WHERE idALuno=".$_SESSION['idAluno'];

    $smt = $con->query($sql);
    
    if(($aluno = $smt->fetch_object()) == true){
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!-- Icone -->
        <!-- Preciso colocar ainda  -->
        <link rel="icon" type="image/png" sizes="16x16" href="../imagens/icon.ico">
        
        <title>Alterar perfil</title>
        
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
                        <div class="col-md">
                            
                            <div class="card">
                                <form class="form-horizontal" action="../../controller/sistemaAluno.php?op=1" method="post">
                                    <div class="card-body">
                                        <h4 class="card-title">Altera perfil :</h4>
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Nome do atleta :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Nome completo" name="nomeAluno" required value="<?php echo $aluno->nomeAluno ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-md-3 text-right control-label col-form-label">Sexo :</label>
                                            <div class="col-md-9">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="control-input" name="sexo" value="Masculino" required checked <?php if($aluno->sexo == 'Masculino') echo 'checked'; ?> >
                                                    <label class="control-label">Masculino</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="control-input" name="sexo" value="Feminino" required <?php if($aluno->sexo == 'Feminino') echo 'checked'; ?> >
                                                    <label class="control-label">Feminino</label>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="form-group row" hidden>
                                            <div class="col-sm-3">
                                                <select name="faixa" class="select2 form-control custom-select">
                                                    <option value="Branca" <?php if($aluno->faixa == 'Branca'){ echo 'selected';} ?> >
                                                        Branca
                                                    </option>
                                                    <option value="Cinza" <?php if($aluno->faixa == 'Cinza'){ echo 'selected';} ?> >
                                                        Cinza
                                                    </option>
                                                    <option value="Azul" <?php if($aluno->faixa == 'Azul'){ echo 'selected';} ?> >
                                                        Azul
                                                    </option>
                                                    <option value="Amarela" <?php if($aluno->faixa == 'Amarela'){ echo 'selected';} ?>>
                                                        Amarela
                                                    </option>
                                                    <option value="Laranja" <?php if($aluno->faixa == 'Laranja'){ echo 'selected';} ?>>
                                                        Laranja
                                                    </option>
                                                    <option value="Verde" <?php if($aluno->faixa == 'Verde'){ echo 'selected';} ?> >
                                                        Verde
                                                    </option>
                                                    <option value="Roxa" <?php if($aluno->faixa == 'Roxa'){ echo 'selected';} ?> >
                                                        Roxa
                                                    </option>
                                                    <option value="Marrom" <?php if($aluno->faixa == 'Marrom'){ echo 'selected';} ?> >
                                                        Marrom
                                                    </option>
                                                    <option value="Preta 1° Dan" <?php if($aluno->faixa == 'Preta 1° Dan'){ echo 'selected';} ?> >
                                                        Preta 1° Dan
                                                    </option>
                                                    <option value="Preta 2° Dan" <?php if($aluno->faixa == 'Preta 2° Dan'){ echo 'selected';} ?> >
                                                        Preta 2° Dan
                                                    </option>
                                                    <option value="Preta 3° Dan" <?php if($aluno->faixa == 'Preta 3° Dan'){ echo 'selected';} ?> >
                                                        Preta 3° Dan
                                                    </option>
                                                    <option value="Preta 4° Dan" <?php if($aluno->faixa == 'Preta 4° Dan'){ echo 'selected';} ?> >
                                                        Preta 4° Dan
                                                    </option>
                                                    <option value="Preta 5° Dan" <?php if($aluno->faixa == 'Preta 5° Dan'){ echo 'selected';} ?> >
                                                        Preta 5° Dan
                                                    </option>
                                                </select>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <select name="categoria" class="select2 form-control custom-select">
                                                    <option value="Super-Ligeiro"  <?php if($aluno->categoria == 'Preta 5° Dan'){ echo 'selected';} ?>>
                                                        Super-Ligeiro
                                                    </option>
                                                    <option value="Ligeiro" <?php if($aluno->categoria == 'Ligeiro'){ echo 'selected';} ?> >
                                                        Ligeiro
                                                    </option>
                                                    <option value="Meio-Leve" <?php if($aluno->categoria == 'Meio-Leve'){ echo 'selected';} ?> >
                                                        Meio-Leve
                                                    </option>
                                                    <option value="Leve" <?php if($aluno->categoria == 'Leve'){ echo 'selected';} ?> >
                                                        Leve
                                                    </option>
                                                    <option value="Meio-Médio" <?php if($aluno->categoria == 'Meio-Médio'){ echo 'selected';} ?> >
                                                        Meio-Médio
                                                    </option>
                                                    <option value="Médio" <?php if($aluno->categoria == 'Médio'){ echo 'selected';} ?> >
                                                        Médio
                                                    </option>
                                                    <option value="Meio-Pesado" <?php if($aluno->categoria == 'Meio-Pesado'){ echo 'selected';} ?> >
                                                        Meio-Pesado
                                                    </option>
                                                    <option value="Pesado" <?php if($aluno->categoria == 'Pesado'){ echo 'selected';} ?> >
                                                        Pesado
                                                    </option>
                                                    <option value="Super-Pesado" <?php if($aluno->categoria == 'Super-Pesado'){ echo 'selected';} ?> >
                                                        Super-Pesado
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">RG do atleta :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: 00.000.000-0" maxlength="12" minlength="12" name="rgAluno" required value="<?php echo $aluno->rgAluno ?>">
                                            </div>
                                            
                                            <label class="col-sm-3 text-right control-label col-form-label">CPF do atleta :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: 000.000.000-00" maxlength="14" minlength="14" name="cpfAluno" required value="<?php echo $aluno->cpfAluno ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Data de nascimento :</label>
                                            <div class="col-sm-3">
                                                <input type="date" class="form-control" name="dataNasc" required value="<?php echo $aluno->dataNasc ?>">
                                            </div>
                                            
                                            <div class="col-sm-3" hidden>
                                                <input type="date" class="form-control" name="dataEmissaoRegistro" required value="<?php echo $aluno->dataEmissaoRegistro ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Restrição médica :</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="4" name="restricaoMed"><?php echo $aluno->restricaoMed ?></textarea>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Endereço :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Ex: Rua Barbosa" name="rua" required value="<?php echo $aluno->rua ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Bairro :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: Centro" name="bairro" required value="<?php echo $aluno->bairro ?>">
                                            </div>
                                            
                                            <label class="col-sm-3 text-right control-label col-form-label">N° da casa :</label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" step="1" name="numero" required value="<?php echo $aluno->numero ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Nome do responsável :</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" placeholder="Nome completo" name="nomeResponsavel" required value="<?php echo $aluno->nomeResponsavel ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">RG do responsável :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: 00.000.000-0" maxlength="12" minlength="12" name="rgResponsavel" required value="<?php echo $aluno->rgResponsavel ?>">
                                            </div>
                                            
                                            <label class="col-sm-3 text-right control-label col-form-label">CPF do responsável :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: 000.000.000-00" maxlength="14" minlength="14" name="cpfResponsavel" required value="<?php echo $aluno->cpfResponsavel ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Telefone do atleta :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: (000) 00000-0000" maxlength="16" minlength="16" name="telAluno" required value="<?php echo $aluno->telAluno ?>">
                                            </div>
                                            
                                            <label class="col-sm-3 text-right control-label col-form-label">Telefone do responsável :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: (000) 00000-0000" maxlength="16" minlength="16" name="telResponsavel" required value="<?php echo $aluno->telResponsavel ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Telefone fixo :</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" placeholder="Ex: 0000-0000" maxlength="9" minlength="9" name="telFixo" required value="<?php echo $aluno->telFixo ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Email do atleta:</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="emailAluno" required value="<?php echo $aluno->emailAluno ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-sm-3 text-right control-label col-form-label">Email do responsável :</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" name="emailResponsavel" required value="<?php echo $aluno->emailResponsavel ?>">
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="numFPJ" required value="<?php echo $aluno->numFPJ ?>" hidden>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="date" class="form-control" name="anoValidade" required value="<?php echo $aluno->anoValidade ?>" hidden>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row" hidden>
                                            <div class="col-sm-3">
                                                <select name="tipoFederado" class="select2 form-control custom-select">
                                                    <option value="Aspirante" value="<?php if($aluno->tipoFederado == 'Aspirante'){ echo 'selected'; } ?>">Aspirante</option>
                                                    <option value="Especial" value="<?php if($aluno->tipoFederado == 'Especial'){ echo 'selected'; } ?>">Especial</option>
                                                </select>
                                            </div>
                                            
                                            <label class="col-sm-3 m-t-15 text-right control-label col-form-label">Turma :</label>
                                            <div class="col-md-3">
                                                
                                                <?php
                                                    include_once "../../model/Turma.php";
                                                    $turma = new Turma();

                                                    echo $turma->alterarTurmaAluno($aluno->turma);
                                                ?>

                                            </div>
                                        </div>
                                        <input type="number" name="idLogin" value="<?php echo $aluno->idlogin?>" hidden>
                                    </div>
                                    
                                    <div class="border-top">
                                        <div class="card-body" align="right">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fas fa-edit"></i>
                                                Alterar
                                            </button>
                                            <a href="perfil.php" class="btn btn-warning">
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
                <!-- End Container fluid  -->
        </div>
        
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
        
        <script src="../js/jquery.magnific-popup.min.js"></script>
        <script src="../js/meg.init.js"></script>
    </body>
</html>

<?php
    }
?>