<?php 
    class Aluno{
        private $idAluno;
        private $nomeAluno;
        private $sexo;
        private $categoria;
        private $faixa;
        private $rgAluno;
        private $cpfAluno;
        private $dataNasc;
        private $restricaoMed;
        private $dataEmissaoRegistro;
        private $rua;
        private $bairro;
        private $numero;
        private $nomeResponsavel;
        private $rgResponsavel;
        private $cpfResponsavel;
        private $telAluno;
        private $telResponsavel;
        private $telFixo;
        private $emailAluno;
        private $emailResponsavel;
        private $numFPJ;
        private $controle;
        private $anoValidade;
        private $tipoFederado;
        private $turma;
        private $idcidade;
        private $iddelegacia;
        private $idlogin;
        private $idacademia;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function detalheAtleta($idAluno){
            $this->idAluno = $idAluno;
        
            $con = $this->con();

            $sql = "SELECT * FROM Aluno INNER JOIN Cidade ON Aluno.idcidade=Cidade.idCidade INNER JOIN Delegacia ON Aluno.iddelegacia = Delegacia.idDelegacia INNER JOIN Login ON Aluno.idlogin = Login.idLogin INNER JOIN Turma ON Aluno.turma = Turma.idTurma WHERE Aluno.idAluno=".$this->idAluno;

            $smt = $con->query($sql);

            $aluno = $smt->fetch_object();

            $detalhe = "<table class='table table-bordered table-striped'>
                            <thead>
                                <tr align='center'> 
                                    <th colspan='2'><b>Dados do Atleta</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class='span3'><b>Nome do atleta</b></th>
                                    <td>$aluno->nomeAluno</td>
                                </tr>
                                <tr>
                                    <th><b>Sexo</b></th>
                                    <td>$aluno->sexo</td>
                                </tr>
                                <tr>
                                    <th><b>Categoria</b></th>
                                    <td>$aluno->categoria</td>
                                </tr>
                                <tr>
                                    <th><b>Faixa</b></th>
                                    <td>$aluno->faixa</td>
                                </tr>
                                <tr>
                                    <th><b>RG do atleta</b></th>
                                    <td>$aluno->rgAluno</td>
                                </tr>
                                <tr>
                                    <th><b>CPF do atleta</b></th>
                                    <td>$aluno->cpfAluno</td>
                                </tr>
                                <tr>
                                    <th><b>Data de Nascimento</b></th>                            
                                    <td>$aluno->dataNasc</td>
                                </tr>
                                <tr>
                                    <th><b>Restrição médica</b></th>
                                    <td>$aluno->restricaoMed</td>
                                </tr>
                                <tr>
                                    <th><b>Data de emissão</b></th>
                                    <td>$aluno->dataEmissaoRegistro</td>
                                </tr>
                                <tr>
                                    <th><b>Rua da residência</b></th>
                                    <td>$aluno->rua</td>
                                </tr>
                                <tr>
                                    <th><b>Bairro</b></th>
                                    <td>$aluno->bairro</td>
                                </tr>
                                <tr>
                                    <th><b>Número de residência</b></th>
                                    <td>$aluno->numero</td>
                                </tr>
                                <tr>
                                    <th><b>Nome do responsável</b></th>
                                    <td>$aluno->nomeResponsavel</td>
                                </tr>
                                <tr>
                                    <th><b>RG do responsável</b></th>
                                    <td>$aluno->rgResponsavel</td>
                                </tr>
                                <tr>
                                    <th><b>CPF do responsável</b></th>
                                    <td>$aluno->cpfResponsavel</td>
                                </tr>
                                <tr>
                                    <th><b>Celular do atleta</b></th>
                                    <td>$aluno->telAluno</td>
                                </tr>
                                <tr>
                                    <th><b>Celular do responsável</b></th>
                                    <td>$aluno->telResponsavel</td>
                                </tr>
                                <tr>
                                    <th><b>Telefone fixo</b></th>
                                    <td>$aluno->telFixo</td>
                                </tr>
                                <tr>
                                    <th><b>Email do atleta</b></th>
                                    <td>$aluno->emailAluno</td>
                                </tr>
                                <tr>
                                    <th><b>Email do responsável</b></th>
                                    <td>$aluno->emailResponsavel</td>
                                </tr>
                                <tr>
                                    <th><b>Número da FPJ</b></th>
                                    <td>$aluno->numFPJ</td>
                                </tr>
                                <tr>
                                    <th><b>Ano de válidade da FPJ</b></th>
                                    <td>$aluno->anoValidade</td>
                                </tr>
                                <tr>
                                    <th><b>Tipo de federação</b></th>
                                    <td>$aluno->tipoFederado</td>
                                </tr>
                                <tr>
                                    <th><b>Turma</b></th>
                                    <td>$aluno->nomeTurma</td>
                                </tr>
                                <tr>
                                    <th><b>Usuário de acesso</b></th>
                                    <td>$aluno->usuario</td>
                                </tr>
                                <tr>
                                    <th><b>Senha</b></th>
                                    <td>$aluno->senha</td>
                                </tr>
                            </tbody>
                        </table>
                            ";

            return  $detalhe;
        }
        
        public function listaAtleta(){
            $con = $this->con();
            
            $sql = "SELECT * FROM Aluno INNER JOIN Academia ON Aluno.idacademia = Academia.idAcademia WHERE Aluno.idAcademia=".$_SESSION['idAcademia']." ORDER BY Aluno.nomeAluno";
            
            $smt = $con->query($sql);
            
            $tabela = "<table id='zero_config' class='table table-striped table-bordered'>
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Número FPJ</th>
                                <th>Categoria</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            while(($atleta = $smt->fetch_object()) == true){
            
            $tabela .= "<tr class='gradeX'>
                            <td>$atleta->nomeAluno</td>
                            <td>$atleta->numFPJ</td>
                            <td>$atleta->categoria</td>
                            <td>
                                <a class='btn btn-primary' href='alteraAtleta.php?idAltera=$atleta->idAluno'>
                                    <i class='fas fa-edit'></i>
                                    Alterar/Excluir
                                </a>
                                <a class='btn btn-secondary' href='detalheAtleta.php?id=$atleta->idAluno'>
                                    <i class='fas fa-ellipsis-h'></i>
                                    Mais
                                </a>
                            </td>
                        </tr>";
                
            }
            
            return  $tabela .= "</tbody>
                    </table>";
            
        }
        
        public function excluirAlunoAcademia($idacademia){
            $this->idacademia = $idacademia;
            
            $con = $this->con();
            
            $sql = "SELECT * FROM Aluno";
            
            $smt = $con->query($sql);
            
            include_once "Login.php";
            
            $excluiLogin = new Login();
            
            while(($aluno = $smt->fetch_object()) == true){
                $login = $aluno->idlogin;
                
                $sql = "DELETE FROM Aluno WHERE idacademia=".$this->idacademia;
                
                $con->query($sql);
                
                $excluiLogin->excluirLogin($login);
            }
        }
        
        public function excluirAluno($idAluno){
            $this->idAluno = $idAluno;
            
            $con = $this->con();
            
            $sql = "DELETE FROM Aluno WHERE idAluno=".$this->idAluno;
            
            $smt = $con->query($sql);
        }
        
        public function alterarAluno($idAluno){
            $this->idAluno = $idAluno;
            
            $con = $this->con();
            
            $sql = "UPDATE Aluno SET nomeAluno=?, sexo=?, categoria=?, faixa=?, rgAluno=?, cpfAluno=?, dataNasc=?, restricaoMed=?, dataEmissaoRegistro=?, rua=?, bairro=?, numero=?, nomeResponsavel=?, rgResponsavel=?, cpfResponsavel=?, telAluno=?, telResponsavel=?, telFixo=?, emailAluno=?, emailResponsavel=?, numFPJ=?, controle=?, anoValidade=?, tipoFederado=?, turma=?, idcidade=?, iddelegacia=?, idlogin=?, idacademia=? WHERE idAluno=".$this->idAluno;
            
            $smt = $con->prepare($sql);
            $smt->bind_param("sssssisssssssssiiissiissiiiii",
                                $this->nomeAluno,
                                $this->sexo,
                                $this->categoria,
                                $this->faixa,
                                $this->rgAluno,
                                $this->cpfAluno,
                                $this->dataNasc,
                                $this->restricaoMed,
                                $this->dataEmissaoRegistro,
                                $this->rua,
                                $this->bairro,
                                $this->numero,
                                $this->nomeResponsavel,
                                $this->rgResponsavel,
                                $this->cpfResponsavel,
                                $this->telAluno,
                                $this->telResponsavel,
                                $this->telFixo,
                                $this->emailAluno,
                                $this->emailResponsavel,
                                $this->numFPJ,
                                $this->controle,
                                $this->anoValidade,
                                $this->tipoFederado,
                                $this->turma,
                                $this->idcidade,
                                $this->iddelegacia,
                                $this->idlogin,
                                $this->idacademia
                            );
            
            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function cadastrarAluno(){
            $con = $this->con();
            
            $sql = "INSERT INTO Aluno VALUES(null, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            
            $smt = $con->prepare($sql);
            $smt->bind_param("sssssssssssssssssssssissiiiii",
                                $this->nomeAluno,
                                $this->sexo,
                                $this->categoria,
                                $this->faixa,
                                $this->rgAluno,
                                $this->cpfAluno,
                                $this->dataNasc,
                                $this->restricaoMed,
                                $this->dataEmissaoRegistro,
                                $this->rua,
                                $this->bairro,
                                $this->numero,
                                $this->nomeResponsavel,
                                $this->rgResponsavel,
                                $this->cpfResponsavel,
                                $this->telAluno,
                                $this->telResponsavel,
                                $this->telFixo,
                                $this->emailAluno,
                                $this->emailResponsavel,
                                $this->numFPJ,
                                $this->controle,
                                $this->anoValidade,
                                $this->tipoFederado,
                                $this->turma,
                                $this->idcidade,
                                $this->iddelegacia,
                                $this->idlogin,
                                $this->idacademia
                            );
            
            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function construtor($nomeAluno, $sexo, $categoria, $faixa, $rgAluno, $cpfAluno,                                $dataNasc, $restricaoMed, $dataEmissaoRegistro, $rua, $bairro,                            $numero, $nomeResponsavel, $rgResponsavel, $cpfResponsavel,                                $telAluno, $telResponsavel, $telFixo, $emailAluno,                                        $emailResponsavel, $numFPJ, $controle, $anoValidade,                                      $tipoFederado, $turma, $idcidade, $iddelegacia, $idlogin,                                          $idacademia)
        {
            $this->nomeAluno = $nomeAluno;
            $this->sexo = $sexo;
            $this->categoria = $categoria;
            $this->faixa = $faixa;
            $this->rgAluno = $rgAluno;
            $this->cpfAluno = $cpfAluno;
            $this->dataNasc = $dataNasc;
            $this->restricaoMed = $restricaoMed;
            $this->dataEmissaoRegistro = $dataEmissaoRegistro;
            $this->rua = $rua;
            $this->bairro = $bairro;
            $this->numero = $numero;
            $this->nomeResponsavel = $nomeResponsavel;
            $this->rgResponsavel = $rgResponsavel;
            $this->cpfResponsavel = $cpfResponsavel;
            $this->telAluno = $telAluno;
            $this->telResponsavel = $telResponsavel;
            $this->telFixo = $telFixo;
            $this->emailAluno = $emailAluno;
            $this->emailResponsavel = $emailResponsavel;
            $this->numFPJ = $numFPJ;
            $this->controle = $controle;
            $this->anoValidade = $anoValidade;
            $this->tipoFederado = $tipoFederado;
            $this->turma = $turma;
            $this->idcidade = $idcidade;
            $this->iddelegacia = $iddelegacia;
            $this->idlogin = $idlogin;
            $this->idacademia = $idacademia;
        }
        
        public function setIdAluno($idAluno){
            $this->idaluno = $idAluno;
        }
        public function getIdAluno(){
            return $this->idAluno;
        }
        
        
        public function setNomeALuno($nomeAluno){
            $this->nomeAluno = $nomeAluno;
        }
        public function getNomeAluno(){
            return $this->nomeAluno;
        }
        
        
        public function setSexo($sexo){
            $this->sexo = $sexo;
        }
        public function getSexo(){
            return $this->sexo;
        }
        
        
        public function setCategoria($categoria){
            $this->categoria = $categoria;
        }
        public function getCategoria(){
            return $this->categoria;
        }
        
        
        public function setFaixa($faixa){
            $this->faixa = $faixa;
        }
        public function getFaixa(){
            return $this->faixa;
        }
        
        
        public function setRgAluno($rgAluno){
            $this->rgAluno = $rgAluno;
        }
        public function getRgAluno(){
            return $this->rgAluno;
        }
        
        
        public function setCpfAluno($cpfAluno){
            $this->cpfAluno = $cpfAluno;
        }
        public function getCpfAluno(){
            return $this->cpfAluno;
        }
        
        
        public function setDataNasc($dataNasc){
            $this->dataNasc = $dataNasc;
        }
        public function getDataNasc(){
            return $this->dataNasc;
        }
        
            
        public function setRestricaoMed($restricaoMed){
            $this->restricaoMed = $restricaoMed;
        }
        public function getRestricaoMed(){
            return $this->restricaoMed;
        }
        
        
        public function setDataEmissaoRegistro($dataEmissaoRegistro){
            $this->dataEmissaoRegistro = $dataEmissaoRegistro;
        }
        public function getDataEmissaoRegistro(){
            return $this->dataEmissaoRegistro;
        }
        
        
        public function setRua($rua){
            $this->rua = $rua;
        }
        public function getRua(){
            return $this->rua;
        }
        
        
        public function setBairro($bairro){
            $this->bairro = $bairro;
        }
        public function getBairro(){
            return $this->bairro;
        }
        
        
        public function setNumero($numero){
            $this->numero = $numero;
        }
        public function getNumero(){
            return $this->numero;
        }
        
        
        public function setNomeResponsavel($nomeResponsavel){
            $this->nomeResponsavel = $nomeResponsavel;
        }
        public function getNomeResponsavel(){
            return $this->nomeResponsavel;
        }
        
        
        public function setRgResponsavel($rgResponsavel){
            $this->rgResponsavel = $rgResponsavel;
        }
        public function getRgResponsavel(){
            return $this->rgResponsavel;
        }
        
        
        public function setCpfResponsavel($cpfResponsavel){
            $this->cpfResponsavel = $cpfResponsavel;
        }
        public function getCpfResponsavel(){
            return $this->cpfResponsavel;
        }
        
        
        public function setTelAluno($telAluno){
            $this->telAluno = $telAluno;
        }
        public function getTelAluno(){
            return $this->telAluno;
        }
        
        
        public function setTelResponsavel($telResponsavel){
            $this->telResponsavel = $telResponsavel;
        }
        public function getTelResponsavel(){
            return $this->telResponsavel;
        }
        
        
        public function setTelFixo($telFixo){
            $this->telFixo = $telFixo;
        }
        public function getTelFixo(){
            return $this->telFixo;
        }
        
        
        public function setEmailAluno($emailAluno){
            $this->emailAluno = $emailAluno;
        }
        public function getEmailAluno(){
            return $this->emailAluno;
        }
        
        
        public function setEmailResponsavel($emailResponsavel){
            $this->emailResponsavel = $emailResponsavel;
        }
        public function getEmailResponsavel(){
            return $this->emailResponsavel;
        }
        
        
        public function setNumFPJ($numFPJ){
            $this->numFPJ = $numFPJ;
        }
        public function getNumFPJ(){
            return $this->numFPJ;
        }
        
        
        public function setControle($controle){
            $this->controle = $controle;
        }
        public function getControle(){
            return $this->controle;
        }
        
        
        public function setAnoValidade($anoValidade){
            $this->anoValidade = $anoValidade;
        }
        public function getAnoValidade(){
            return $this->anoValidade;
        }
        
        
        public function setTipoFederado($tipoFederado){
            $this->tipoFederado = $tipoFederado;
        }
        public function getTipoFederado(){
            return $this->tipoFederado;
        }
        
        
        public function setTurma($turma){
            $this->turma = $turma;
        }
        public function getTurma(){
            return $this->turma;
        }
        
        
        public function setIdCidade($idcidade){
            $this->idcidade = $idcidade;
        }
        public function getIdCidade(){
            return $this->idcidade;
        }
        
        
        public function setIdDelegacia($iddelegacia){
            $this->iddelegacia = $iddelegacia;
        }
        public function getIdDelegacia(){
            return $this->iddelegacia;
        }
        
        
        public function setIdLogin($idlogin){
            $this->idlogin = $idlogin;
        }
        public function getIdLogin(){
            return $this->idlogin;
        }
        
        
        public function setIdAcademia($idacademia){
            $this->idacademia = $idacademia;
        }
        public function getIdAcademia(){
            return $this->idacademia;
        }
    }
?>