<?php
    class Chamada{
        private $idacademia;
        private $idaluno;
        private $diaAula;
        private $presente;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function listaChamada(){
            $con = $this->con();
            
            $sql = "SELECT *, COUNT(Chamada.idaluno) AS quantidadeDeFaltas FROM Chamada INNER JOIN Aluno ON Chamada.idaluno=Aluno.idAluno  WHERE Chamada.idacademia=".$_SESSION['idAcademia']." GROUP BY Chamada.idaluno ORDER BY Aluno.nomeAluno";
            
            $smt = $con->query($sql);
            
            $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Nome do atleta</th>
                                <th class='alert-danger'>Quantidade de Faltas</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>";
            while(($chamada = $smt->fetch_object()) == true){
            
            $tabela .= "<tr class='gradeX'>
                            <td>$chamada->nomeAluno</td>
                            <td>";
                                    if(($chamada->quantidadeDeFaltas) != 0){ 
                                        $tabela .= "$chamada->quantidadeDeFaltas"; 
                                    }

                   $tabela.="</td>
                            <td>";
                                if(($chamada->quantidadeDeFaltas) != 0){ 
                                        $tabela .= "<a class='btn btn-secondary' href='detalheChamada.php?id=$chamada->idaluno'>
                                                        <i class='fas fa-ellipsis-h''></i>
                                                        Mais
                                                    </a>"; 
                                }
                $tabela .= "</td>
                        </tr>";                
            }
            
            return  $tabela .= "</tbody>
                        </table>";
        }
        
        public function excluirFalta($idaluno, $diaAula){
            $this->idaluno = $idaluno;
            $this->diaAula = $diaAula;
            
            $con = $this->con();
            
            $sql = "DELETE FROM Chamada WHERE idaluno=".$this->idaluno." AND diaAula='".$this->diaAula."'";
            
            $smt = $con->query($sql);
        }
        
        public function exibirFaltaAluno($idaluno){
            $this->idaluno = $idaluno;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Chamada WHERE idaluno=".$this->idaluno;
            
            $smt = $con->query($sql);
            
            $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Dias em que faltou</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            while(($falta = $smt->fetch_object()) == true){
                $tabela .= "<tr>
                                <td>$falta->diaAula</td>
                                <td>
                                    <a class='btn btn-danger' href='../../controller/sistemaAcademia.php?op=8&idExclui=$falta->idaluno&dia=$falta->diaAula'>
                                        <i class='fas fa-trash'></i>
                                        Tirar falta
                                    </a>
                                </td>
                           </tr>";
            }
            
            return  $tabela .= "</tbody>
                        </table>";
        }
        
        public function exibirChamadaEfetuada(){
            $con = $this->con();
            
            $sql = "SELECT *, COUNT(Chamada.idaluno) AS quantidadeDeFaltas FROM Chamada INNER JOIN Aluno ON Chamada.idaluno=Aluno.idAluno  WHERE Chamada.idacademia=".$_SESSION['idAcademia']." GROUP BY Chamada.idaluno ORDER BY Aluno.nomeAluno";

            $smt = $con->query($sql);

            $exibe = "<table class='table table-bordered'>
                            <tr>
                                <th>Nome Atleta</th>
                                <th class='alert-danger'>Quantidade de Faltas</th>
                                <th width='100'>Ação</th>
                            </tr>";
                
            while(($chamada = $smt->fetch_object()) == true){
                $exibe .= "<tr>
                                <td>$chamada->nomeAluno</td>
                                <td>";
                                    if(($chamada->quantidadeDeFaltas) != 0){ 
                                        $exibe .= "$chamada->quantidadeDeFaltas"; 
                                    }

                                $exibe.="</td>
                                <td>";
                                    if(($chamada->quantidadeDeFaltas) != 0){ 
                                            $exibe .= "<a class='btn btn-secondary' href='alterarFalta.php?id=$chamada->idaluno'>
                                                <i class='fas fa-ellipsis-h'></i>
                                                Mais
                                            </a>"; 
                                    }

                                $exibe .= "</td>
                           </tr>";
            }

            return $exibe .= "</table>";
        }
        
        public function excluirChamadaAluno($idaluno){
            $this->idaluno = $idaluno;
            
            $con = $this->con();
            
            $sql = "DELETE FROM Chamada WHERE idaluno=".$this->idaluno;
            
            $smt = $con->query($sql);
        }
        
        public function excluirChamadaAcademia($idacademia){
            $this->idacademia = $idacademia;
            
            $con = $this->con();
            
            $sql = "DELETE FROM Chamada WHERE idacademia=".$this->idacademia;
            
            $smt = $con->query($sql);
        }
        
        public function exibirFaltas($idaluno){
            $this->idaluno = $idaluno;
            
            $con = $this->con();
            
            $sql = "SELECT *, COUNT(Chamada.idaluno) as quantidadeDeFaltas FROM Chamada INNER JOIN Aluno ON Chamada.idaluno=Aluno.idAluno INNER JOIN Turma ON Aluno.turma = Turma.idTurma WHERE Chamada.idaluno=$this->idaluno AND Chamada.idacademia=".$_SESSION['idAcademia'];
            
            $smt = $con->query($sql);
            
            $informacao = $smt->fetch_object();
            
            $exibe = "<br><table class='table table-bordered'>
                            <tr>
                                <td width='200'><b>Nome do Atleta:</b></td>
                                <td>$informacao->nomeAluno</td>
                            </tr>
                            <tr>
                                <td><b>Sexo:</b></td>
                                <td>$informacao->sexo</td>
                            </tr>
                            <tr>
                                <td><b>Categoria:</b></td>
                                <td>$informacao->categoria</td>
                            </tr>
                            <tr>
                                <td><b>Faixa:</b></td>
                                <td>$informacao->faixa</td>
                            </tr>
                            <tr>
                                <td><b>RG do Atleta:</b></td>
                                <td>$informacao->rgAluno</td>
                            </tr>
                            <tr>
                                <td><b>CPF do Atleta:</b></td>
                                <td>$informacao->cpfAluno</td>
                            </tr>
                            <tr>
                                <td><b>Data de Nascimento:</b></td>
                                <td>$informacao->dataNasc</td>
                            </tr>
                            <tr>
                                <td><b>Restrição Médica:</b></td>
                                <td>$informacao->restricaoMed</td>
                            </tr>
                            <tr>
                                <td><b>Rua:</b></td>
                                <td>$informacao->rua</td>
                            </tr>
                            <tr>
                                <td><b>Bairro:</b></td>
                                <td>$informacao->bairro</td>
                            </tr>
                            <tr>
                                <td><b>Número do Logradouro:</b></td>
                                <td>$informacao->numero</td>
                            </tr>
                            <tr>
                                <td><b>Nome do Responsável:</b></td>
                                <td>$informacao->nomeResponsavel</td>
                            </tr>
                            <tr>
                                <td><b>RG do Responsável:</b></td>
                                <td>$informacao->rgResponsavel</td>
                            </tr>
                            <tr>
                                <td><b>CPF do Responsável</b></td>
                                <td>$informacao->cpfResponsavel</td>
                            </tr>
                            <tr>
                                <td><b>Telefone do Aluno:</b></td>
                                <td>$informacao->telAluno</td>
                            </tr>
                            <tr>
                                <td><b>Telefone do Responsável:</b></td>
                                <td>$informacao->telResponsavel</td>
                            </tr>
                            <tr>
                                <td><b>Telefone Fixo:</b></td>
                                <td>$informacao->telFixo</td>
                            </tr>
                            <tr>
                                <td><b>Email do Aluno:</b></td>
                                <td>$informacao->emailAluno</td>
                            </tr>
                            <tr>
                                <td><b>Email do Responsável:</b></td>
                                <td>$informacao->emailResponsavel</td>
                            </tr>
                            <tr>
                                <td><b>Número de identidade da FPJ:</b></td>
                                <td>$informacao->numFPJ</td>
                            </tr>
                            <tr>
                                <td><b>Identidade da FPJ válida até:</b></td>
                                <td>$informacao->anoValidade</td>
                            </tr>
                            <tr>
                                <td><b>Classe:</b></td>
                                <td>$informacao->tipoFederado</td>
                            </tr>
                            <tr>
                                <td><b>Turma de Treino:</b></td>
                                <td>$informacao->nomeTurma</td>
                            </tr>
                            <tr>
                                <td class='alert-danger'><b>Quantidade de Faltas:</b></td>
                                <td>$informacao->quantidadeDeFaltas</td>
                            </tr>
                            ";
            
            $sql= "SELECT * FROM Login INNER JOIN Aluno ON Login.idlogin = Aluno.idlogin WHERE Login.idLogin=".$informacao->idlogin;
                    
            $smt = $con->query($sql);
            
            $login = $smt->fetch_object();
            
            $exibe .= "<tr>
                        <td><b>Login:</b></td>
                        <td>$login->usuario</td>
                    </tr>
                   </table>";
            
            
            return $exibe;
        }
        
        public function cadastrarChamada(){
            $con = $this->con();
            
            $sql = "INSERT INTO Chamada VALUES(null, ?, ?, ?, ?)";
            
            $smt = $con->prepare($sql);
            $smt->bind_param("iiss",
                                $this->idacademia,
                                $this->idaluno,
                                $this->diaAula,
                                $this->presente
                            );
            
            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function exibirChamada($turma){
            $this->turma = $turma;
            
            $con = $this->con();

            $sql = "SELECT * FROM Aluno INNER JOIN Academia ON Aluno.idacademia = Academia.idAcademia WHERE Aluno.turma='$this->turma' AND Aluno.idAcademia=".$_SESSION['idAcademia']." ORDER BY Aluno.nomeAluno";

            $smt = $con->query($sql);

            $tabela = "<form class='form-horizontal' action='../../controller/sistemaAcademia.php?op=7' method='post'>
                            <div class='card-body'>
                                <h4 class='card-title'>Chamada de Atletas</h4>
                                <div class='form-group row'>
                                    <label class='col-sm-3 text-right control-label col-form-label'>Dia da aula :</label>
                                    <div class='col-sm-9'>
                                        <input type='date' class='form-control' name='diaAula' required>
                                    </div>
                                </div>
                             </div>

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

                    $tabela .= "    <tr>
                                        <th>
                                            <label class='customcheckbox'>
                                                <input type='checkbox' class='listCheckbox' name='presente[$aluno->idAluno]' value='$aluno->idAluno'>
                                                <span class='checkmark'></span>
                                            </label>
                                        </th>
                                        <td>$aluno->nomeAluno</td>
                                    </tr>
                                ";

                }

            return  $tabela .= "            </tbody>
                                        </table>
                                    </div>
                                <div class='border-top'>
                                    <div class='card-body' align='right'>
                                        <button type='submit' class='btn btn-primary'>
                                            <i class='fas fa-clipboard-list'></i>
                                            Efetuar chamada
                                        </button>
                                    </div>
                                </div>
                            </form>";
        }
        
        public function construtor($idacademia, $idaluno, $diaAula, $presente){
            $this->idacademia = $idacademia;
            $this->idaluno = $idaluno;
            $this->diaAula = $diaAula;
            $this->presente = $presente;
        }
        
        public function setIdAcademia($idacademia){
            $this->idacademia = $idacademia;
        }
        public function getIdAcademia(){
            return $this->idacademia;
        }
        
        
        public function setIdAluno($idaluno){
            $this->idAluno = $idAluno;
        }
        public function getIdAluno(){
            return $this->idaluno;
        }
        
        
        public function setDiaAula($diaAula){
            $this->diaAula = $diaAula;    
        }
        public function getDiaAula(){
            return $this->diaAula;
        }
        
        
        public function setPresente($presente){
            $this->presente = $presente;
        }
        public function getPresente(){
            return $this->presente;
        }
    }
?>