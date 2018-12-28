<?php
    class Turma{
        private $idTurma;
        private $nomeTurma;
        private $idacademia;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function excluirTurma($idTurma){
            $this->idTurma = $idTurma;
            
            $con = $this->con();
            
            $sql = "DELETE FROM Turma WHERE idTurma=".$this->idTurma;
            
            $smt = $con->query($sql);
        }
        
        public function alterarTurma($idTurma){
            $this->idTurma = $idTurma;
            
            $con = $this->con();

            $sql = "UPDATE Turma SET nomeTurma=?, idacademia=? WHERE idTurma=".$this->idTurma;

            $smt = $con->prepare($sql);        

            $smt->bind_param("si",
                             $this->nomeTurma,
                             $this->idacademia
                            );

            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function exibirTurmaAcademia($idacademia){
            $this->idacademia = $idacademia;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Turma WHERE idacademia=".$this->idacademia;
            
            $smt = $con->query($sql);
            
            $exibe = "<table class='table table-bodered'>
                        <tr>
                            <th>Nome da Turma</th>
                            <th>Ação</th>
                        </tr>";
            
            while(($turma = $smt->fetch_object()) == true){
                $exibe .= "<tr>
                                <td>$turma->nomeTurma</td>
                                <td><a href='alterarTurma.php?id=$turma->idTurma' class='btn btn-primary'>Alterar/Excluir</a></td>
                           </tr>";
            }
            
            return $exibe .= "</table>";
        }
        
        public function alterarTurmaAluno($turma){
            $this->turma = $turma;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Turma WHERE idacademia=".(int)$_SESSION['idAcademia'];
            
            $smt = $con->query($sql);
            
            $exibe = "<select name='turma' class='select2 form-control custom-select'>";
            
            while(($chamada = $smt->fetch_object()) == true ){
                $exibe .= "<option value='$chamada->idTurma'";
                            if($chamada->idTurma == $this->turma){
                                $exibe .= "selected";
                            }
                
                $exibe .= ">$chamada->nomeTurma</option>";
            }
            
            return $exibe .= "</select>";
        }
        
        public function listaTurma($idacademia){
            $this->idacademia = $idacademia;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Turma WHERE idacademia=".$this->idacademia;
            
            $smt = $con->query($sql);
            
            $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Turma</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            while(($turma = $smt->fetch_object()) == true){
            
            $tabela .= "<tr class='gradeX'>
                            <td>$turma->nomeTurma</td>
                            <td>
                                <a class='btn btn-primary' href='alteraTurma.php?idAltera=$turma->idTurma'>
                                    <i class='fas fa-edit'></i>
                                    Alterar/Excluir
                                </a>
                            </td>
                        </tr>";
                
            }
            
        return  $tabela .= "</tbody>
                    </table>";
        }
        
        public function exibirTurma($idacademia){
            $this->idacademia = $idacademia;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Turma WHERE idacademia=".$this->idacademia;
            
            $smt = $con->query($sql);
            
            $exibe = "<select name='turma' class='select2 form-control custom-select'>";
            
            while(($chamada = $smt->fetch_object()) == true ){
                $exibe .= "<option value='$chamada->idTurma'>$chamada->nomeTurma</option>";
            }
            
            return $exibe .= "</select>";
        }
        
        public function cadastrarTurma(){
            $con = $this->con();

            $sql = "INSERT INTO Turma VALUES(null, ?, ?)";

            $smt = $con->prepare($sql);        
            
            $smt->bind_param("si",
                             $this->nomeTurma,
                             $this->idacademia
                            );

            $smt->execute();
            $smt->close();
            $con->close(); 
        }
        
        public function construtor($nomeTurma, $idacademia){
            $this->nomeTurma = $nomeTurma;
            $this->idacademia = $idacademia;
        }
        
        
        public function setIdTurma($idTurma){
            $this->idTurma = $idTurma;
        }
        public function getIdTurma(){
            return $this->idTurma;
        }
        
        
        public function setNomeTurma($nomeTurma){
            $this->nomeTurma = $nomeTurma;
        }
        public function getNomeTurma(){
            return $this->nomeTurma;
        }
        
        
        public function setIdacademia($idacademia){
            $this->idacademia = $idacademia;
        }
        public function getIdacademia(){
            return $this->idacademia;
        }
    }
?>