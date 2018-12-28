<?php 
    class Delegacia{
        private $idDelegacia;
        private $regiao;
        private $numero;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function excluirDelegacia($idDelegacia){
            $this->idDelegacia = $idDelegacia;

            $con = $this->con();

            $sql = "SELECT * FROM Delegacia WHERE idDelegacia=".$this->idDelegacia;

            $smt = $con->query($sql);

            $academia = $smt->fetch_object();

            $_SESSION['idExclui'] = $academia->idlogin;

            $sql = "DELETE FROM Delegacia WHERE idDelegacia=".$this->idDelegacia;

            $smt = $con->query($sql);

        }
        
        public function alterarDelegacia($idDelegacia){
            $this->idDelegacia = $idDelegacia;
            
            $con = $this->con();
            
            $sql = "UPDATE Delegacia SET regiao=?, numero=? WHERE idDelegacia=".$this->idDelegacia;
            
            $smt = $con->prepare($sql);
            $smt->bind_param("si",
                                $this->regiao,
                                $this->numero
                            );
            
            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function listaDelegacia(){
            $con = $this->con();

            $sql = "SELECT * FROM Delegacia";

            $smt = $con->query($sql);

            $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                            <thead>
                                <tr>
                                    <th>Delegacia</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>";

                while(($delegacia = $smt->fetch_object()) == true){

                $tabela .= "<tr class='gradeX'>
                                <td>$delegacia->regiao</td>
                                <td>
                                    <a class='btn btn-primary' href='alteraDelegacia.php?idAltera=$delegacia->idDelegacia'>
                                        <i class='fas fa-edit'></i>
                                        Alterar/Excluir
                                    </a>
                                </td>
                            </tr>";

                }

            return  $tabela .= "</tbody>
                        </table>";
        }
        
        public function verificarSeDelegaciaCadastrada($numero){
            $this->numero = $numero;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Delegacia WHERE numero=".$this->numero;
            
            $smt = $con->query($sql);
            
            if($smt->fetch_object() == true){
                $pode = "não";
                
                return $pode;
            }else{
                $pode = "sim";
                
                return $pode;
            }
        }
        
        public function cadastrarDelegacia(){
            $con = $this->con();
            
            $sql = "INSERT INTO Delegacia VALUES(null, ?, ?)";
            
            $smt = $con->prepare($sql);        
            
            $smt->bind_param("si",
                             $this->regiao,
                             $this->numero
                            );

            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function exibirDelegaciaAltera($idDelegacia){
            $this->idDelegacia = $idDelegacia;
            
            $con = $this->con();

            $sql = "SELECT * FROM Delegacia";

            $smt = $con->query($sql);

            $tabela = '<select name="idDelegacia" >';

                while(($delegacia = $smt->fetch_object()) == true){

                    $tabela .= "<option value='$delegacia->idDelegacia'";
                        
                        if($delegacia->idDelegacia == $this->idDelegacia){
                            $tabela .= "selected";
                        }
                    
                    $tabela .= ">$delegacia->regiao</option>";
                }

            return  $tabela .= "</select>";
        }
        
        public function exibirDelegacia(){
            $con = $this->con();

            $sql = "SELECT * FROM Delegacia";

            $smt = $con->query($sql);

            $tabela = '<select name="idDelegacia" class="select2 form-control custom-select">';

                while(($delegacia = $smt->fetch_object()) == true){

                    $tabela .= "<option value='$delegacia->idDelegacia'>$delegacia->regiao</option>";
                }

            return  $tabela .= "</select>";
        }
        
        public function construtor($regiao, $numero){
            $this->regiao = $regiao;
            $this->numero = $numero;
        }
        
        public function setIdDelegacia($idDelegacia){
            $this->idDelegacia = $dDelegacia;
        }
        public function getIdDelegacia(){
            return $this->idDelegacia;
        }
        
        
        public function setRegiao($regiao){
            $this->regiao = $regiao;
        }
        public function getRegiao(){
            return $this->regiao;
        }
        
        
        public function setNumero($numero){
            $this->numero = $numero;
        }
        public function getNumero(){
            return $this->numero;
        }
    }
?>