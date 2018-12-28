<?php
    session_start();
    
    //Cadastra Turma
    if($_GET['op'] == 1){
        include_once "../model/Turma.php";
        
        $turma = new Turma();
        $turma->construtor($_POST['nomeTurma'],
                          (int)$_SESSION['idAcademia']
        );
        
        $turma->cadastrarTurma();
        
        $_SESSION['mensagemCadTurma'] = "<div class='alert alert-success' role='alert'>Turma cadastrada com Sucesso!</div>";
        
        header("Location: ../view/academia/cadTurma.php");
    }

    //Altera Turma
    if($_GET['op'] == 2){
        include_once "../model/Turma.php";
        
        $turma = new Turma();
        $turma->construtor($_POST['nomeTurma'],
                          (int)$_SESSION['idAcademia']
        );
        
        $turma->alterarTurma($_GET['idAltera']);
        
        $_SESSION['mensagemAlteraTurma'] = "<div class='alert alert-success' role='alert'>Turma alterada com sucesso!</div>";
        
        header("Location: ../view/academia/listaTurma.php");
    }

    //Exclui Turma
    if($_GET['op'] == 3){
        include_once "../model/Conexao.php";
        
        $conexao = new Conexao();
        $con  = $conexao->conectar();
        $sql = "SELECT idAluno, idlogin FROM Aluno WHERE turma=".$_GET['idExclui'];
        $smt = $con->query($sql);
        
        while(($aluno = $smt->fetch_object()) == true){
            $idAluno = $aluno->idAluno; //id do aluno pego
            $idLogin = $aluno->idlogin;  //id do login do aluno pego
            
            include_once "../model/Chamada.php";
            
            $chamada = new Chamada();
            $chamada->excluirChamadaAluno($idAluno);
            
            include_once "../model/Aluno.php";

            $aluno = new Aluno();
            $aluno->excluirAluno($idAluno);

            include_once "../model/Login.php";

            $login = new Login();
            $login->excluirLogin($idLogin);
        }
        
        include_once "../model/Turma.php";
        $turma = new Turma();
        $turma->excluirTurma($_GET['idExclui']);
        
        $_SESSION['mensagemExcluiTurma'] = "<div class='alert alert-success' role='alert'>Turma excluida com sucesso!</div>";
            
        header("Location: ../view/academia/listaTurma.php");
    }

    //Cadastra Alteta
    if($_GET['op'] == 4){
        //Cadastrar Login da Academia
        if($_POST['senha'] == $_POST['confirmaSenha']){
            $_SESSION['idPerfil'] =  $_SESSION['idLogin'];

            include_once "../model/Login.php";

            $login = new Login();
            $login->construtor($_POST['usuario']."@aluno.com",
                               $_POST['senha']);

            if(($login->vereficarLoginExistente()) == "sim"){
                $login->cadastrarLogin();
                $login->buscarLoginParaCadastro();

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
                                      (int)$_SESSION['codigoAcademia'],
                                      $_POST['anoValidade'],
                                      $_POST['tipoFederado'],
                                      $_POST['turma'],
                                      (int)$_SESSION['idcidade'],
                                      (int)$_SESSION['iddelegacia'],
                                      (int)$_SESSION['idLogin'],
                                      (int)$_SESSION['idAcademia']
                                     );
                
                $aluno->cadastrarAluno();
                
                //Retorna o id do Logado
                $_SESSION['idLogin'] =  $_SESSION['idPerfil'];
                unset($_SESSION['idPerfil']);

                $_SESSION['mensagemCadAtleta'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso</div>";

                header("Location: ../view/academia/cadAtleta.php");
            }else{
                $_SESSION['mensagemCadAtleta'] = "<div class='alert alert-danger' role='alert'>Já existe Aluno com esse Usuário!<br>Por favor escolha outro Usuário!</div>";
                header("Location: ../view/academia/cadAtleta.php");
            }
        }else{
            $_SESSION['mensagemCadAtleta'] = "<div class='alert alert-danger' role='alert'>As Senhas não se correspondem!</div>";
            
            header("Location: ../view/academia/cadAtleta.php");
        }
    }
    
    //Altera Altela
    if($_GET['op'] == 5){
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
                              (int)$_SESSION['codigoAcademia'],
                              $_POST['anoValidade'],
                              $_POST['tipoFederado'],
                              $_POST['turma'],
                              (int)$_SESSION['idcidade'],
                              (int)$_SESSION['iddelegacia'],
                              $_POST['idLogin'],
                              (int)$_SESSION['idAcademia']
                             );
        
        $aluno->alterarAluno($_GET['idAltera']);
        
        $_SESSION['mensagemAlteraAlteta'] = "<div class='alert alert-success' role='alert'>Atleta alterado com sucesso!</div>";
        
        header("Location: ../view/academia/listaAtleta.php");
    }

    //Exclui Atleta
    if($_GET['op'] == 6){
        include_once "../model/Conexao.php";
        
        $conexao = new Conexao();
        $con  = $conexao->conectar();
        $sql = "SELECT idlogin FROM Aluno WHERE idAluno=".$_GET['idExclui'];
        $smt = $con->query($sql);
        $retorno = $smt->fetch_object();
        $idLogin = $retorno->idlogin;
        
        include_once "../model/Chamada.php";
            
        $chamada = new Chamada();
        $chamada->excluirChamadaAluno($_GET['idExclui']);
        
        include_once "../model/Aluno.php";

        $aluno = new Aluno();
        $aluno->excluirAluno($_GET['idExclui']);
        
        include_once "../model/Login.php";

        $login = new Login();
        $login->excluirLogin($idLogin);
        
        $_SESSION['mensagemExcluiAtleta'] = "<div class='alert alert-success' role='alert'>Atleta excluido com Sucesso</div>";
        
        header("Location: ../view/academia/listaAtleta.php");
    }

    //Cadastrar chamada
    if($_GET['op'] == 7){
        include_once "../model/Chamada.php";
        
        if(!empty($_POST['presente'])){
            $pre = $_POST['presente'];
            
            foreach($pre as $presente){
                $chamada = new Chamada();    
                $chamada->construtor($_SESSION['idAcademia'],
                                     $presente,
                                     $_POST['diaAula'],
                                     "Sim"
                );
                $chamada->cadastrarChamada();
                
                $_SESSION['mensagemCadChamada'] = "<div class='alert alert-success' role='alert'>Chamada realizada com sucesso!</div>";
                
                header("Location: ../view/academia/cadChamada.php");
            }
            
        }else{
            $_SESSION['mensagemCadChamada'] = "<div class='alert alert-success' role='alert'>Ninguém faltou !<br>Chamada realizada com sucesso!</div>";
            
            header("Location: ../view/academia/cadChamada.php");
        }
    }

    //Exlcuir chamada
    if($_GET['op'] == 8){
        include_once "../model/Chamada.php";
        
        $chamada = new Chamada();
        $chamada->excluirFalta($_GET['idExclui'], $_GET['dia']);
        
        $_SESSION['mensagem'] = "<div class='alert alert-success' role='alert'>Falta retirada!</div>";
        
        header("Location: ../view/academia/listaChamada.php");
    }

    //Gerando relção dos atletas que irão participar
    if($_GET['op'] == 9){
        include_once "../model/Conexao.php";
        $conexao = new Conexao();
        $con = $conexao->conectar();
        
        $sql = "SELECT * FROM Campeonato WHERE idCampeonato=".$_GET['idCampeonato'];
        
        $smt = $con->query($sql);
        
        $campeonato = $smt->fetch_object();
	
        $pagina = 
            "<html>
                <body>
                    <h1 align='center'>Federação Paulista de Judô</h1>
                    <h3 align='center'>$campeonato->nomeCampeonato</h3>
                    <p>Atletas que irão participar: </p>
                    <table border='1' style='border-collapse: collapse' align='center'>
                        <tr align='center'>
                            <th width='5%'></th>
                            <th width='55%'>Nome do Atleta</th>
                            <th>Categoria</th>
                            <th>Ano de Nascimento</th>
                        </tr>";
        
        if(!empty($_POST['idAluno'])){
            $aluno = $_POST['idAluno'];
            $quantidade = 1;
            
            foreach($aluno as $qual){
                $sql = "SELECT * FROM Aluno WHERE idAluno=".$qual;
                $smt = $con->query($sql);
                $dados = $smt->fetch_object();
                
                $pagina .= "<tr>
                                <td align='center'>$quantidade</td>
                                <td align='lefth'>$dados->nomeAluno</td>
                                <td align='center'>$dados->categoria</td>
                                <td align='center'>$dados->dataNasc</td>
                            </tr>";
                
                $quantidade++;
            }
            
            $pagina .= "</table>";
            
            $_SESSION['relato'] = "<div class='alert alert-success' role='alert'>Relatório gerado com Sucesso!</div>";
            
            include_once "../model/PDF/mpdf.php";
            
            $mpdf = new mPDF();
            $mpdf->WriteHTML($pagina);

            $arquivo = "RelacaoDeAtletas.pdf";
            $mpdf->Output($arquivo, 'I');
            
        }else{
            $_SESSION['relato'] = "<div class='alert alert-danger' role='alert'>Você precisa escolher quem vai pro Campeonato!</div>";
            
            header("Location: ../view/academia/listaCampeonato.php");
            
        }
    }

    if($_GET['op'] == 10){
        include_once "../model/Academia.php";

        $academia = new Academia();
        $academia->construtor($_POST["nomeAcademia"],
                              $_POST["codigoAcademia"],
                              $_POST["sensei"],
                              $_POST["local"],
                              $_POST["email"],
                              $_POST["telefone"],
                              $_POST["idCidade"],
                              $_POST["idDelegacia"],
                              0
        );
        
        $academia->alterarAcademia($_SESSION['idAcademia']);

        $_SESSION['mensagemAlteraPerfil'] = "<div class='alert alert-success' role='alert'>Perfil alterado com sucesso!</div>";
        
        header("Location: ../view/academia/perfil.php");
    }
?>