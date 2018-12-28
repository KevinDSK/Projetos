<?php
    session_start();

    if($_GET['op'] == 1){
        include_once "../model/Aluno.php";

        $aluno = new Aluno();
        $aluno->construtor($_POST['nomeAluno'],
                              $_POST['sexo'],
                              $_POST['categoria'],
                              $_POST['faixa'],
                              $_POST['rgAluno'],
                              $_POST['cpfAluno'],
                              $_POST['dataNasc'],
                              $_POST['restricaoMed'],
                              $_POST['dataEmissaoRegistro'],
                              $_POST['rua'],
                              $_POST['bairro'],
                              $_POST['numero'],
                              $_POST['nomeResponsavel'],
                              $_POST['rgResponsavel'],
                              $_POST['cpfResponsavel'],
                              $_POST['telAluno'],
                              $_POST['telResponsavel'],
                              $_POST['telFixo'],
                              $_POST['emailAluno'],
                              $_POST['emailResponsavel'],
                              $_POST['numFPJ'],
                              (int)$_SESSION['controle'],
                              $_POST['anoValidade'],
                              $_POST['tipoFederado'],
                              $_SESSION['turma'],
                              (int)$_SESSION['idcidade'],
                              (int)$_SESSION['iddelegacia'],
                              $_POST['idLogin'],
                              (int)$_SESSION['idacademia']
                             );
        
        $aluno->alterarAluno($_SESSION['idAluno']);
        
        $_SESSION['mensagemAlteraPerfil'] = "<div class='alert alert-success' role='alert'>Perfil alterado com sucesso!</div>";
        
        header("Location: ../view/aluno/perfil.php");
    }
?>