<?php
    session_start();
    
    //Cadastra Academia
    if($_GET['op'] == 1){
        //Cadastrar Login da Academia
        if($_POST['senha'] == $_POST['confirmaSenha']){
            $_SESSION['idPerfil'] =  $_SESSION['idLogin'];

            include_once "../model/Login.php";

            $login = new Login();
            $login->construtor($_POST['usuario']."@academia.com",
                               $_POST['senha']);
            
            if(($login->vereficarLoginExistente()) == "sim"){
                $login->cadastrarLogin();
                $login->buscarLoginParaCadastro();

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
                                      (int)$_SESSION["idLogin"]
                                     );
                $academia->cadastrarAcademia();

                //Retorna o id do Logado
                $_SESSION['idLogin'] =  $_SESSION['idPerfil'];
                unset($_SESSION['idPerfil']);

                $_SESSION['mensagemCadAcademia'] = "<div class='alert alert-success' role='alert'>Cadastrado com Sucesso</div>";

                header("Location: ../view/admin/cadAcademia.php");
            }else{
                $_SESSION['mensagemCadAcademia'] = "<div class='alert alert-danger' role='alert'>Já existe Academia com esse Usuário!<br>Por favor escolha outro Usuário!</div>";
                
                header("Location: ../view/admin/cadAcademia.php");
            }
            
        }else{
            $_SESSION['mensagemCadAcademia'] = "<div class='alert alert-danger' role='alert'>As Senhas não se correspondem!</div>";
            
            header("Location: ../view/admin/cadAcademia.php");
        }
    }
    
    //Altera Academia
    if($_GET['op'] == 2){
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
        
        $academia->alterarAcademia($_GET['idAltera']);

        $_SESSION['mensagemAlteraAcademia'] = "<div class='alert alert-success' role='alert'>Academia alterada com sucesso!</div>";
        
        header("Location: ../view/admin/listaAcademia.php");
    }
    
    //Exclui Academia
    if($_GET['op'] == 3){
        include_once "../model/Conexao.php";
        
        $conexao = new Conexao();
        $con = $conexao->conectar();
        
        include_once "../model/Chamada.php";
        
        $chamada = new Chamada();
        $chamada->excluirChamadaAcademia($_GET['idExclui']);
        
        include_once "../model/Aluno.php";
        $aluno = new Aluno();
        
        include_once "../model/Login.php";
        $login = new Login();
        
        $sql = "SELECT idlogin FROM Aluno WHERE idacademia=".$_GET['idExclui'];
        $smt = $con->query($sql);
        
        while(($al = $smt->fetch_object()) == true){
            $idLoginAluno = $al->idlogin;
            
            $aluno->excluirAlunoAcademia($_GET['idExclui']);
            $login->excluirLogin($idLoginAluno);    
        }
        
        $sql = "SELECT idTurma FROM Turma WHERE idacademia=".$_GET['idExclui'];
        $smt = $con->query($sql);
        $t = $smt->fetch_object();
        $idTurma = $t->idTurma;
        
        include_once "../model/Turma.php";
        $turma = new Turma();
        $turma->excluirTurma($idTurma);
        
        include_once "../model/Academia.php";

        $academia = new Academia();
        $academia->excluirAcademia($_GET['idExclui']);
        
        $login->excluirLogin($_SESSION['idExclui']);
            
        $_SESSION['mensagemExcluiAcademia'] = "<div class='alert alert-success' role='alert'>Academia excluido com Sucesso</div>";
        
        header("Location: ../view/admin/listaAcademia.php");
    }

    //Cadastra Delegacia
    if($_GET['op'] == 4){
        include_once "../model/Delegacia.php";
        
        $delegacia = new Delegacia();
        
        if(( $delegacia->verificarSeDelegaciaCadastrada($_POST['numero']) ) == "sim"){
            $delegacia->construtor($_POST['regiao'],
                                   $_POST['numero']
                                  );
            $delegacia->cadastrarDelegacia();

            $_SESSION['mensagemCadDelegacia'] = "<div class='alert alert-success' role='alert'>Delegacia cadastrada com sucesso!</div>";

            header("Location: ../view/admin/cadDelegacia.php");
            
        }else{
            $_SESSION['mensagemCadDelegacia'] = "<div class='alert alert-danger' role='alert'>Já existe uma Delegacia cadastrada com esse Número!</div>";
            
            header("Location: ../view/admin/cadDelegacia.php");
        }
    }
    
    //Altera Delegacia
    if($_GET['op'] == 5){
        include_once "../model/Delegacia.php";
        
        $delegacia = new Delegacia();
        
        $con = new mysqli("localhost", "root", "", "bd_fpj");
        
        $sql = "SELECT * FROM Delegacia WHERE idDelegacia=".$_GET['idAltera'];
        
        $smt = $con->query($sql);
        
        $d = $smt->fetch_object();
        
        if(( $delegacia->verificarSeDelegaciaCadastrada($_POST['numero']) ) == "sim" || 
             $_GET['idAltera'] == $d->idDelegacia){
            
            $delegacia->construtor($_POST['regiao'],
                                   $_POST['numero']
                                  );
            $delegacia->alterarDelegacia($_GET['idAltera']);

            $_SESSION['mensagemAlteraDelegacia'] = "<div class='alert alert-success' role='alert'>Delegacia alterada com sucesso!</div>";

            header("Location: ../view/admin/listaDelegacia.php");
            
        }else{
            $_SESSION['mensagemAlteraDelegacia'] = "<div class='alert alert-danger' role='alert'>Já existe uma Delegacia cadastrada com esse Número!</div>";
            
            header("Location: ../view/admin/listaDelegacia.php");
        }
    }
    
    //Exclui Delegacia
    if($_GET['op'] == 6){
        /* Tenho que pensar um pouco mais, então vou deixar para mais tarde
        
        Delegacia 7
        Academia 5
        Turma 4
        Aluno 2
        Chamada 1
        Login Aluno 3
        Login Academia 6
        
        include_once "../model/Conexao.php";
        $conexao = new Conexao();
        $con = $conexao->conectar();
        
        include_once "../model/Chamada.php";
        
        $chamada = new Chamada();
        $chamada->excluirChamadaAcademia($_GET['idExclui']);
        
        include_once "../model/Aluno.php";
        $aluno = new Aluno();
        
        include_once "../model/Academia.php";
        $academia = new Academia();
        
        include_once "../model/Login.php";
        $login = new Login();
        
        while(($al = $smt->fetch_object()) == true){
            $idLoginAluno = $al->idlogin();
            
            $aluno->excluirAlunoAcademia($_GET['idExclui']);
            $login->excluirLogin($idLoginAluno); 
        }
        
        $sql = "SELECT idAcademia, idlogin FROM Academia WHERE iddelegacia=".$_GET['idExclui'];
        $smt = $con->query($sql);
        
        while(($ac = $smt->fetch_object()) == true){
            $idLoginAcademia = $ac->idLogin;
            
            $login->excluirLogin($idLoginAcademia);
        }
        
        include_once "../model/Turma.php";
        $turma = new Turma();
        $turma->excluirTurma($idTurma);
        
        */
        
        include_once "../model/Delegacia.php";
        
        $delegacia = new Delegacia();
        
        $delegacia->excluirDelegacia($_GET['idExclui']);
        
        $_SESSION['mensagemExcluiDelegacia'] = "<div class='alert alert-success'>
                                                <button class='close' data-dismiss='alert'>×</button>
                                                <strong>Sucesso!</strong> Delegacia excluida!
                                            </div>";
        
        header("Location: ../view/admin/listaDelegacia.php");
    }
    
    //Cadastra Notícia
    if($_GET['op'] == 7){
        $tipos= array('image/jpeg', 'image/pjpeg', 'image/png');
        $tamanhoMaximo = 600 * 372;
        $nomeArquivo = $_FILES['nomeImagem']['name'];
        $tipoArquivo = $_FILES['nomeImagem']['type'];
        $tamanhoArquivo = $_FILES['nomeImagem']['size'];
        $arquivoTemporario = $_FILES['nomeImagem']['tmp_name'];
        $erroArquivo = $_FILES['nomeImagem']['error'];
        
        if($erroArquivo == 0) {
            if(array_search($tipoArquivo, $tipos) != 0){
                $_SESSION['mensagemCadNoticia'] = "<div class='alert alert-danger'>
                                                    <button class='close' data-dismiss='alert'>×</button>
                                                    <strong>Falha!</strong> A imagem selecionada não é do formato .JPG!
                                                  </div>";
                
                header("location: ../view/admin/cadNoticia.php");
                
            }else if($tamanhoArquivo > $tamanhoMaximo){
                $_SESSION['mensagemCadNoticia'] = "<div class='alert alert-danger' role='alert'>A imagem não pode ter tamanho maior que 600 * 372px</div>";
                
                header("location: ../view/admin/cadNoticia.php");
                
            }else{
                $pasta = "C:/xampp/htdocs/PRIORIDADE/view/imagens/";
                $extensao = strtolower(end(explode('.', $nomeArquivo)));
                $nomeFile = time().'.'.$extensao;
                $upload = move_uploaded_file($arquivoTemporario, $pasta.$nomeFile);

                if($upload == true){
                    include_once "../model/Noticia.php";
                    
                    $noticia = new Noticia();
                    $noticia->construtor($_POST['titulo'],
                                         $_POST['descricao'],
                                         $nomeFile
                                        );
                    $noticia->cadastrarNoticia();

                    $_SESSION['mensagemCadNoticia'] = "<div class='alert alert-success'>
                                                <button class='close' data-dismiss='alert'>×</button>
                                                <strong>Sucesso!</strong> Notícia Enviada com Sucesso!
                                            </div>";
                    
                    header("location: ../view/admin/cadNoticia.php");
                }
            }
        }else{
            $_SESSION['mensagemCadNoticia'] = "<div class='alert alert-danger' role='alert'>Ocorreu algum erro ao Enviar a Imagem!</div>";
                
            header("location: ../view/admin/cadNoticia.php");
        }
    }
    
    //Altera Noticia
    if($_GET['op'] == 8){
        $tipos= array('image/jpeg', 'image/pjpeg', 'image/png');
        $tamanhoMaximo = 600 * 372;
        $nomeArquivo = $_FILES['nomeImagem']['name'];
        $tipoArquivo = $_FILES['nomeImagem']['type'];
        $tamanhoArquivo = $_FILES['nomeImagem']['size'];
        $arquivoTemporario = $_FILES['nomeImagem']['tmp_name'];
        $erroArquivo = $_FILES['nomeImagem']['error'];
        
        if($erroArquivo == 0) {
            if(array_search($tipoArquivo, $tipos) != 0){
                $_SESSION['mensagemAlteraNoticia'] = "<div class='alert alert-danger'>
                                                    <button class='close' data-dismiss='alert'>×</button>
                                                    <strong>Falha!</strong> A imagem selecionada não é do formato .JPG!
                                                  </div>";
                
                header("location: ../view/admin/noticia.php");
            
                
            }else if($tamanhoArquivo > $tamanhoMaximo){
                $_SESSION['mensagemAlteraNoticia'] = "<div class='alert alert-danger' role='alert'>A imagem não pode ter tamanho maior que 600 * 372px</div>";
                
                header("location: ../view/admin/noticia.php");
                
            }else{
                $pasta = "C:/xampp/htdocs/PRIORIDADE/view/imagens/";
                $extensao = strtolower(end(explode('.', $nomeArquivo)));
                $nomeFile = time().'.'.$extensao;
                $upload = move_uploaded_file($arquivoTemporario, $pasta.$nomeFile);

                if($upload == true){
                    include_once "../model/Noticia.php";
                    
                    $noticia = new Noticia();
                    $noticia->construtor($_POST['titulo'],
                                         $_POST['descricao'],
                                         $nomeFile
                                        );
                    $noticia->alterarNoticia($_GET['idAltera']);

                    $_SESSION['mensagemAlteraNoticia'] = "<div class='alert alert-success'>
                                                <button class='close' data-dismiss='alert'>×</button>
                                                <strong>Sucesso!</strong> Notícia alterada com Sucesso!
                                            </div>";
                    
                    header("location: ../view/admin/noticia.php");
                }
            }
        }else{
            $_SESSION['mensagemAlteraNoticia'] = "<div class='alert alert-danger' role='alert'>Ocorreu algum erro ao Enviar a Imagem!</div>";
                
            header("location: ../view/admin/noticia.php");
        }
    }
    
    //Exclui Notícia
    if($_GET['op'] == 9){
        include_once "../model/Noticia.php";
        
        $noticia = new Noticia();
        
        $noticia->excluirNoticia($_GET['idExclui']);
        
        $_SESSION['mensagemAlteraNoticia'] = "<div class='alert alert-success'>
                                                <button class='close' data-dismiss='alert'>×</button>
                                                <strong>Sucesso!</strong> Notícia excluida com Sucesso!
                                            </div>";
                    
        header("location: ../view/admin/noticia.php");
    }
    

    //Cadastra Campeonato
    if($_GET['op'] == 10){
        include_once "../model/Campeonato.php";
        
        $evento = new Campeonato();
        $evento->construtor($_POST['nomeCampeonato'],
                            $_POST['tipoCampeonato'],
                            $_POST['data'],
                            $_POST['idCidade'],
                            $_POST["idDelegacia"]);
        $evento->cadastrarCampeonato();
        
        $_SESSION['mensagemCadEvento'] = "<div class='alert alert-success' role='alert'>Evento cadastrado com Sucesso!</div>";
        
        header("Location: ../view/admin/cadCampeonato.php");
    }

    //Logout
    if($_GET['op'] == 11){
        session_destroy();
        
        header("Location: ../index.php");
    }
    
?>