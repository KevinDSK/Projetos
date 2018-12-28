<?php

class Academia{
    private $idacademia;
    private $nomeAcademia;
    private $codigoAcademia;
    private $sensei;
    private $local;
    private $email;
    private $telefone;
    private $idcidade;
    private $iddelegacia;
    private $idlogin;
    
    public function con(){
        include_once("Conexao.php");
        $conexao = new Conexao();
        
        $con = $conexao->conectar();
        
        return $con;
    }
    
    public function detalheAcademiaPublico($idacademia){
        $this->idacademia = $idacademia;
        
        $con = $this->con();

        $sql = "SELECT * FROM Academia INNER JOIN Cidade ON Academia.idcidade=Cidade.idCidade INNER JOIN Delegacia ON Academia.iddelegacia = Delegacia.idDelegacia INNER JOIN Login ON Academia.idlogin = Login.idLogin WHERE Academia.idAcademia=".$this->idacademia;

        $smt = $con->query($sql);
        
        $academia = $smt->fetch_object();
        
        $detalhe = "<table class='table table-bordered table-striped'>
                        <thead>
                            <tr align='center'> 
                                <th colspan='2'><b>Dados da Academia</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class='span3'><b>Nome da Academia</b></th>
                                <td>$academia->nomeAcademia</td>
                            </tr>
                            <tr>
                                <th><b>Código</b></th>
                                <td>$academia->codigoAcademia</td>
                            </tr>
                            <tr>
                                <th><b>Sensei</b></th>
                                <td>$academia->sensei</td>
                            </tr>
                            <tr>
                                <th><b>Local</b></th>
                                <td>$academia->local</td>
                            </tr>
                            <tr>
                                <th><b>Email da Academia</b></th>
                                <td>$academia->email</td>
                            </tr>
                            <tr>
                                <th><b>Telefone</b></th>
                                <td>$academia->telefone</td>
                            </tr>
                            <tr>
                                <th><b>Cidade</b></th>                            
                                <td>$academia->nome</td>
                            </tr>
                            <tr>
                                <th><b>Delegacia</b></th>
                                <td>$academia->regiao</td>
                            </tr>
                        </tbody>
                    </table>
                        ";
        
        return  $detalhe;
    }
    
    public function detalheAcademia($idacademia){
        $this->idacademia = $idacademia;
        
        $con = $this->con();

        $sql = "SELECT * FROM Academia INNER JOIN Cidade ON Academia.idcidade=Cidade.idCidade INNER JOIN Delegacia ON Academia.iddelegacia = Delegacia.idDelegacia INNER JOIN Login ON Academia.idlogin = Login.idLogin WHERE Academia.idAcademia=".$this->idacademia;

        $smt = $con->query($sql);
        
        $academia = $smt->fetch_object();
        
        $detalhe = "<table class='table table-bordered table-striped'>
                        <thead>
                            <tr align='center'> 
                                <th colspan='2'><b>Dados da Academia</b></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class='span3'><b>Nome da Academia</b></th>
                                <td>$academia->nomeAcademia</td>
                            </tr>
                            <tr>
                                <th><b>Código</b></th>
                                <td>$academia->codigoAcademia</td>
                            </tr>
                            <tr>
                                <th><b>Sensei</b></th>
                                <td>$academia->sensei</td>
                            </tr>
                            <tr>
                                <th><b>Local</b></th>
                                <td>$academia->local</td>
                            </tr>
                            <tr>
                                <th><b>Email da Academia</b></th>
                                <td>$academia->email</td>
                            </tr>
                            <tr>
                                <th><b>Telefone</b></th>
                                <td>$academia->telefone</td>
                            </tr>
                            <tr>
                                <th><b>Cidade</b></th>                            
                                <td>$academia->nome</td>
                            </tr>
                            <tr>
                                <th><b>Delegacia</b></th>
                                <td>$academia->regiao</td>
                            </tr>
                            <tr>
                                <th><b>Usuário de acesso</b></th>
                                <td>$academia->usuario</td>
                            </tr>
                            <tr>
                                <th><b>Senha</b></th>
                                <td>$academia->senha</td>
                            </tr>
                        </tbody>
                    </table>
                        ";
        
        return  $detalhe;
    }
    
    public function listaAcademiaPublico(){
        $con = $this->con();

        $sql = "SELECT * FROM Academia INNER JOIN Cidade ON Academia.idcidade=Cidade.idCidade INNER JOIN Delegacia ON Academia.iddelegacia = Delegacia.idDelegacia";

        $smt = $con->query($sql);
        
        $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Academia</th>
                                <th>Sensei</th>
                                <th>Delegacia</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            while(($academia = $smt->fetch_object()) == true){
            
            $tabela .= "<tr class='gradeX'>
                            <td>$academia->nomeAcademia</td>
                            <td>$academia->sensei</td>
                            <td>$academia->regiao</td>
                            <td>
                                <a class='btn btn-secondary' href='detalheAcademia.php?id=$academia->idAcademia'>
                                    <i class='fas fa-ellipsis-h'></i>
                                    Mais
                                </a>
                            </td>
                        </tr>";
                
            }
            
        return  $tabela .= "</tbody>
                    </table>";
    }
    
    public function listaAcademia(){
        $con = $this->con();

        $sql = "SELECT * FROM Academia INNER JOIN Cidade ON Academia.idcidade=Cidade.idCidade INNER JOIN Delegacia ON Academia.iddelegacia = Delegacia.idDelegacia";

        $smt = $con->query($sql);
        
        $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Academia</th>
                                <th>Sensei</th>
                                <th>Delegacia</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            while(($academia = $smt->fetch_object()) == true){
            
            $tabela .= "<tr class='gradeX'>
                            <td>$academia->nomeAcademia</td>
                            <td>$academia->sensei</td>
                            <td>$academia->regiao</td>
                            <td>
                                <a class='btn btn-primary' href='alteraAcademia.php?idAltera=$academia->idAcademia'>
                                    <i class='fas fa-edit'></i>
                                    Alterar/Excluir
                                </a>
                                <a class='btn btn-secondary' href='detalheAcademia.php?id=$academia->idAcademia'>
                                    <i class='fas fa-ellipsis-h'></i>
                                    Mais
                                </a>
                            </td>
                        </tr>";
                
            }
            
        return  $tabela .= "</tbody>
                    </table>";
    }
    
    public function excluirAcademia($idacademia){
        $this->idacademia = $idacademia;
        
        $con = $this->con();
        
        $sql = "SELECT * FROM Academia WHERE idAcademia=".$this->idacademia;
        
        $smt = $con->query($sql);
        
        $academia = $smt->fetch_object();
        
        $_SESSION['idExclui'] = $academia->idlogin;
        
        $sql = "DELETE FROM Academia WHERE idAcademia=".$this->idacademia;
            
        $smt = $con->query($sql);
        
    }
    
    public function alterarAcademia($idacademia){
        $this->idacademia = $idacademia;
        
        $con = $this->con();

        $sql = "UPDATE Academia SET nomeAcademia=?, codigoAcademia=?, sensei=?, local=?, email=?, telefone=?, idcidade=?, iddelegacia=? WHERE idAcademia=".$this->idacademia;
        
        $smt = $con->prepare($sql);        

        $smt->bind_param("sisssiii",
                         $this->nomeAcademia,
                         $this->codigoAcademia,
                         $this->sensei,
                         $this->local,
                         $this->email,
                         $this->telefone,
                         $this->idcidade,
                         $this->iddelegacia
                        );
        
        $smt->execute();
        $smt->close();
        $con->close();
    }
    
    public function cadastrarAcademia()
    {
        $con = $this->con();

        //criar o script SQL de cadastro
        $sql = "INSERT INTO Academia VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?)";   //? <- Parâmetros SQL (SEGURANÇA)
        
        //preparar SQL
        $smt = $con->prepare($sql);        
        //preparar os parâmetros
        $smt->bind_param("sisssiiii",
                         $this->nomeAcademia,
                         $this->codigoAcademia,
                         $this->sensei,
                         $this->local,
                         $this->email,
                         $this->telefone,
                         $this->idcidade,
                         $this->iddelegacia,
                         $this->idlogin
                        );
        
        $smt->execute();
        $smt->close();
        $con->close();
    }

    public function construtor($nomeAcademia, $codigoAcademia, $sensei, $local, $email, $telefone, $idcidade, $iddelegacia, $idlogin)
    {
        $this->nomeAcademia = $nomeAcademia;
        $this->codigoAcademia = $codigoAcademia;
        $this->sensei = $sensei;
        $this->local = $local;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->idcidade = $idcidade;
        $this->iddelegacia = $iddelegacia;
        $this->idlogin = $idlogin;
    }

    
    public function setNomeAcademia($nomeAcademia) {
        $this->nomeAcademia = $nomeAcademia;
    }
    public function getNomeAcademia() {
        return $this->nomeAcademia;
    }
    
    
    public function setCodigoAcademia($codigoAcademia) {
        $this->codigoAcademia = $codigoAcademia;
    }
    public function getCodigoCampeonato() {
        return $this->codigoAcademia;
    }
    
    
    public function setSensei($sensei) {
        $this->sensei = $sensei;
    }
    public function getSensei() {
        return $this->sensei;
    }
    
    
    public function setLocal($local) {
        $this->local = $local;
    }
    public function getLocal() {
        return $this->local;
    }
    
    
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getEmail()
    {
        return $this->email;
    }
    
    
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    }
    public function getTelefone()
    {
        return $this->telefone;
    }
    
    
    public function setIdCidade($idcidade)
    {
        $this->idcidade = $idcidade;
    }
    public function getIdCidade()
    {
        return $this->idcidade;
    }
    
    
    public function setIdDelegacia($iddelegacia)
    {
        $this->iddelegacia = $iddelegacia;
    }
    public function getIdDelegacia()
    {
        return $this->iddelegacia;
    }
    
    
    public function setIdLogin($idlogin)
    {
        $this->idlogin = $idlogin;
    }
    public function getIdLogin()
    {
        return $this->idlogin;
    }
    
}
?>