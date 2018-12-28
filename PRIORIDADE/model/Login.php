<?php

class Login{
        private $usuario;
        private $senha;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function construtor($usuario, $senha){
            $this->usuario = $usuario;
            $this->senha = $senha;
        }
        
        public function cadastrarLogin()
        {
            $con = $this->con();

            //criar o script SQL de cadastro
            $sql = "INSERT INTO Login VALUES(null, ?, ?)";   //? <- Parâmetros SQL (SEGURANÇA)

            //preparar SQL
            $smt = $con->prepare($sql);
            //preparar os parâmetros
            $smt->bind_param("ss",
                             $this->usuario,
                             $this->senha);

            $smt->execute();
            $smt->close();
            $con->close();
        }

        public function excluirLogin($idLogin){
            $this->idLogin = $idLogin;
            
            $con = $this->con();
            
            $sql = "DELETE FROM Login WHERE idLogin=".$this->idLogin;
            
            $smt = $con->query($sql);
        }
    
        public function vereficarLoginExistente(){
            $con = $this->con();
            
            $sql = "SELECT * FROM Login WHERE usuario='".$this->usuario."'";
            
            $smt = $con->query($sql);
            $pode = "";
            
            if(($smt->fetch_object()) == true){  
                $pode = "não";
                return $pode;
            }else{
                $pode = "sim";
                return $pode;
            }
            
        }
    
        public function verificarLogin()
        {
            $con = $this->con();
            
            $sql= "SELECT * FROM Login WHERE usuario='$this->usuario' AND senha='$this->senha'";
            $smt = $con->query($sql);
            
            if(($smt->fetch_object()) != false){
                
                $sql = "SELECT * FROM Login WHERE RIGHT(usuario, 10) = '@aluno.com' AND usuario='$this->usuario'";
                $smt = $con->query($sql);
                
                if($smt->fetch_object() == true){
                    $sql= "SELECT * FROM Login INNER JOIN Aluno ON Login.idlogin = Aluno.idlogin WHERE usuario='$this->usuario' AND senha='$this->senha'";
                    
                    $smt = $con->query($sql);
                    $global = $smt->fetch_object();
                    
                    $_SESSION['idLogin'] = $global->idLogin;
                    $_SESSION['usuario'] = $global->usuario;
                    $_SESSION['senha'] = $global->senha;
                    $_SESSION['idAluno'] = $global->idAluno;
                    $_SESSION['nomeAluno'] = $global->nomeAluno;
                    $_SESSION['sexo'] = $global->sexo;
                    $_SESSION['categoria'] = $global->categoria;
                    $_SESSION['faixa'] = $global->faixa;
                    $_SESSION['rgAluno'] = $global->rgAluno;
                    $_SESSION['cpfAluno'] = $global->cpfAluno;
                    $_SESSION['dataNasc'] = $global->dataNasc;
                    $_SESSION['restricaoMed'] = $global->restricaoMed;
                    $_SESSION['dataEmissaoRegistro'] = $global->dataEmissaoRegistro;
                    $_SESSION['rua'] = $global->rua;
                    $_SESSION['bairro'] = $global->bairro;
                    $_SESSION['numero'] = $global->numero;
                    $_SESSION['nomeResponsavel'] = $global->nomeResponsavel;
                    $_SESSION['rgResponsavel'] = $global->rgResponsavel;
                    $_SESSION['cpfResponsavel'] = $global->cpfResponsavel;
                    $_SESSION['telAluno'] = $global->telAluno;
                    $_SESSION['telResponsavel'] = $global->telResponsavel;
                    $_SESSION['telFixo'] = $global->telFixo;
                    $_SESSION['emailAluno'] = $global->emailAluno;
                    $_SESSION['emailResponsavel'] = $global->emailResponsavel;
                    $_SESSION['numFPJ'] = $global->numFPJ;
                    $_SESSION['controle'] = $global->controle;
                    $_SESSION['anoValidade'] = $global->anoValidade;
                    $_SESSION['tipoFederado'] = $global->tipoFederado;
                    $_SESSION['turma'] = $global->turma;
                    $_SESSION['idcidade'] = $global->idcidade;
                    $_SESSION['iddelegacia'] = $global->iddelegacia;
                    $_SESSION['idlogin'] = $global->idlogin;
                    $_SESSION['idacademia'] = $global->idacademia;
                    
                    $smt->close();
                    $con->close();
                    
                    return "Location: ../view/aluno/index.php";
                }

                $sql = "SELECT * FROM Login WHERE RIGHT(usuario, 13) = '@academia.com' AND usuario='$this->usuario'";
                $smt = $con->query($sql);

                if($smt->fetch_object() == true){
                    $sql= "SELECT * FROM Login INNER JOIN Academia ON Login.idlogin = Academia.idlogin WHERE usuario='$this->usuario' AND senha='$this->senha'";
                    
                    $smt = $con->query($sql);
                    $global = $smt->fetch_object();

                    $_SESSION['idLogin'] = $global->idLogin;
                    $_SESSION['usuario'] = $global->usuario;
                    $_SESSION['senha'] = $global->senha;
                    $_SESSION['idAcademia'] = $global->idAcademia;
                    $_SESSION['nomeAcademia'] = $global->nomeAcademia;
                    $_SESSION['codigoAcademia'] = $global->codigoAcademia;
                    $_SESSION['sensei'] = $global->sensei;
                    $_SESSION['local'] = $global->local;
                    $_SESSION['email'] = $global->email;
                    $_SESSION['telefone'] = $global->telefone;
                    $_SESSION['idcidade'] = $global->idcidade;
                    $_SESSION['iddelegacia'] = $global->iddelegacia;
                    
                    
                    $smt->close();
                    $con->close();
                    
                    return "Location: ../view/academia/index.php";
                }

                $sql = "SELECT * FROM Login WHERE RIGHT(usuario, 8) = '@adm.com' AND usuario='$this->usuario'";
                $smt = $con->query($sql);
                
                if($smt->fetch_object() == true){
                    $sql= "SELECT * FROM Login WHERE usuario='$this->usuario' AND senha='$this->senha'";
                    
                    $smt = $con->query($sql);
                    $global = $smt->fetch_object();
                    
                    $_SESSION['idLogin'] = $global->idLogin;
                    $_SESSION['logado'] = "sim";
                    $_SESSION['usuario'] = $global->usuario;
                    $_SESSION['senha'] = $global->senha;
                    
                    $smt->close();
                    $con->close();
                    
                    return "Location: ../view/admin/index.php";
                }
            }else{
                $smt->close();
                $con->close();
                
                session_start();
                $_SESSION['mensagemLogin'] = "<div class='alert alert-danger' role='alert'>Email ou Senha inválidos!</div>";
        
                return "Location: ../login.php";
            }
        }
    
        public function buscarLoginParaCadastro(){
            $con = $this->con();
            
            $sql= "SELECT * FROM Login WHERE usuario='$this->usuario' AND senha='$this->senha'";
            
            $smt = $con->query($sql);
            $busca = $smt->fetch_object();
            
            $_SESSION['idLogin'] = $busca->idLogin;
            
            $smt->close();
            $con->close();
        }
    
    
        public function setUsuario($usuario)
        {   
            $this->usuario = $usuario;
        }
        public function getUsuario()
        {
            return $this->usuario;
        }
    
    
        public function setSenha($senha)
        {
            $this->senha = $senha;
        }
        public function getSenha()
        {
            return $this-> $senha;
        }
    }
?>