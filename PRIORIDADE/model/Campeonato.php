<?php

    class Campeonato{
        private $nomeCampeonato;
        private $tipoCampeonato;
        private $data;
        private $idcidade;
        private $iddelegacia;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function exibirLista($idCampeonato){
            $this->idCampeonato = $idCampeonato;
            
            $con = $this->con();

            $sql = "SELECT * FROM Aluno INNER JOIN Academia ON Aluno.idacademia = Academia.idAcademia WHERE Aluno.idAcademia=".$_SESSION['idAcademia']." ORDER BY Aluno.nomeAluno";

            $smt = $con->query($sql);

            $tabela = "<form class='form-horizontal' action='../../controller/sistemaAcademia.php?op=9&idCampeonato=".$this->idCampeonato."' method='post'>
                            <div class='table-responsive'>
                                <table class='table'>
                                    <thead class='thead-light'>
                                        <tr>
                                            <th>
                                                <label class='customcheckbox m-b-20'>
                                                    <input type='checkbox' id='mainCheckbox'>
                                                    <span class='checkmark'></span>
                                                </label>
                                            </th>
                                            <th scope='col'>Nome do atleta</th>
                                        </tr>
                                    </thead>
                                    <tbody class='customtable'>";    

            while(($aluno = $smt->fetch_object()) == true){                
                 $tabela .= "   <tr>
                                    <th>
                                        <label class='customcheckbox'>
                                            <input type='checkbox' class='listCheckbox' name='idAluno[$aluno->idAluno]' value='$aluno->idAluno'>
                                            <span class='checkmark'></span>
                                        </label>
                                    </th>
                                    <td>$aluno->nomeAluno</td>
                                </tr>
                                ";

            }

            return  $tabela .= "      </tbody>
                                    </table>
                                </div>
                                <div class='border-top'>
                                    <div class='card-body' align='right'>
                                        <button type='submit' class='btn btn-primary'>
                                            <i class='far fa-file'></i>
                                            Gerar relação
                                        </button>
                                    </div>
                                 </div>";
        }

        public function cadastrarCampeonato()
        {
            $con = $this->con();

            $sql = "INSERT INTO Campeonato VALUES(null, ?, ?, ?, ?, ?)";

            $smt = $con->prepare($sql);
            
            $smt->bind_param("sssii",
                             $this->nomeCampeonato,
                             $this->tipoCampeonato,
                             $this->data,
                             $this->idcidade,
                             $this->iddelegacia
            );

            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function construtor($nomeCampeonato, $tipoCampeonato,
                                     $data, $idcidade, $iddelegacia)
        {
            $this->nomeCampeonato = $nomeCampeonato;
            $this->tipoCampeonato = $tipoCampeonato;
            $this->data = $data;
            $this->idcidade = $idcidade;
            $this->iddelegacia = $iddelegacia;
        }

        public function setNomeCampeonato($nomeCampeonato) {
            $this->nomeCampeonato = $nomeCampeonato;
        }
        public function getNomeCampeonato() {
            return $this->nomeCampeonato;
        }
        
        
        public function setTipoCampeonato($tipoCampeonato) {
            $this->tipoCampeonato = $tipoCampeonato;;
        }
        public function getTipoCampeonato() {
            return $this->tipoCampeonato;
        }
        
        
        public function setData($data) {
            $this->data = $data;
        }
        public function getData() {
            return $this->data;
        }
        
        
        public function setIdCidade($idcidade) {
            $this->idcidade = $idcidade;
        }
        public function getIdCidade() {
            return $this->$idcidade;
        }
        
        
        public function setIdDelegacia($iddelegacia) {
            $this->iddelegacia = $iddelegacia;
        }
        public function getIdDelegacia() {
            return $this->iddelegacia;
        }
    }
?>