<?php
    class Cidade{
        private $idCidade;
        private $nome;
        private $idestado;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function exibirCidadeAltera($idCidade){
            $this->idCidade = $idCidade;
            
            $con = $this->con();

            $sql = "SELECT * FROM Cidade";

            $smt = $con->query($sql);

            $tabela = '<select name="idCidade" class="select2 form-control custom-select">';

                while(($cidade = $smt->fetch_object()) == true){

                    $tabela .= "<option value='$cidade->idCidade'";
                    
                        if($this->idCidade == $cidade->idCidade){ 
                            $tabela .= " selected"; 
                        }
                    
                    $tabela.= ">$cidade->nome</option>";
                }

            return  $tabela .= "</select>";
        }
        
        public function exibirCidade(){
            $con = $this->con();

            $sql = "SELECT * FROM Cidade";

            $smt = $con->query($sql);

            $tabela = '<select name="idCidade" class="select2 form-control custom-select">';

                while(($cidade = $smt->fetch_object()) == true){

                    $tabela .= "<option value='$cidade->idCidade'>$cidade->nome</option>";
                }

            return  $tabela .= "</select>";
        }
        
        public function setIdCidade($idCidade){
            $this->idCidade = $idCidade;
        }
        public function getIdCidade(){
            return $this->idCidade;
        }
        
        
        public function setNome($nome){
            $this->nome = $nome;
        }
        public function getNome(){
            return $this->nome;
        }
        
        
        public function setIdEstado($idestado){
            $this->idestado = $idestado;
        }
        public function getIdEstado(){
            return $this->idestado;
        }
    }
?>