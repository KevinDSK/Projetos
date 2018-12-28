<?php
    class Noticia{
        private $titulo;
        private $descricao;
        private $nomeImagem;
        
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function noticiaPublico(){
            $con = $this->con();

            $sql = "SELECT * FROM Noticia";
            
            $smt = $con->query($sql);
            
            $exibe = "";
            
            while(($noticia = $smt->fetch_object()) == true){
                $exibe .= "<div class='col-lg-4 col-md-7'>
                            <div class='card'>
                                <div class='el-card-item'>
                                    <div class='el-card-avatar el-overlay-1'> 
                                        <img src='view/imagens/$noticia->nomeImagem' alt='$noticia->nomeImagem'>
                                        <div class='el-overlay'>
                                            <ul class='list-style-none el-info'>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline image-popup-vertical-fit el-link' href='view/imagens/$noticia->nomeImagem'>
                                                        <i class='mdi mdi-magnify-plus'></i>
                                                    </a>
                                                </li>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline el-link' href='detalheNoticia.php?idNoticia=$noticia->idNoticia'>
                                                        Mais...
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='el-card-content'>
                                        <h4 class='m-b-0'>$noticia->titulo</h4>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
            
            return $exibe;
        }
        
        public function listaNoticiaPublico(){
            $con = $this->con();

            $sql = "SELECT * FROM Noticia LIMIT 3";
            
            $smt = $con->query($sql);
            
            $exibe = "";
            
            while(($noticia = $smt->fetch_object()) == true){
                $exibe .= "<div class='col-lg-4 col-md-7'>
                            <div class='card'>
                                <div class='el-card-item'>
                                    <div class='el-card-avatar el-overlay-1'> 
                                        <img src='view/imagens/$noticia->nomeImagem' alt='$noticia->nomeImagem'>
                                        <div class='el-overlay'>
                                            <ul class='list-style-none el-info'>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline image-popup-vertical-fit el-link' href='view/imagens/$noticia->nomeImagem'>
                                                        <i class='mdi mdi-magnify-plus'></i>
                                                    </a>
                                                </li>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline el-link' href='detalheNoticia.php?idNoticia=$noticia->idNoticia'>
                                                        Mais...
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='el-card-content'>
                                        <h4 class='m-b-0'>$noticia->titulo</h4>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
            
            return $exibe;
        }
        
        public function detalheNoticiaPublico($idNoticia){
            $this->idNoticia = $idNoticia;

            $con = $this->con();

            $sql = "SELECT * FROM Noticia WHERE idNoticia=".$this->idNoticia;

            $smt = $con->query($sql);

            $noticia = $smt->fetch_object();

            $detalhe = "<h3 align='center'> &nbsp;<b class='text-danger'>$noticia->titulo</b></h3>
                        <br>
                        <div class='p-20'>
                            <div align='center' class='col-12'>
                                <img src='view/imagens/$noticia->nomeImagem' class='img-fluid'>
                            </div>
                            <br>
                            <p align='justify'>$noticia->descricao</p>
                        </div>";

            return  $detalhe;
        }
        
        public function detalheNoticia($idNoticia){
            $this->idNoticia = $idNoticia;

            $con = $this->con();

            $sql = "SELECT * FROM Noticia WHERE idNoticia=".$this->idNoticia;

            $smt = $con->query($sql);

            $noticia = $smt->fetch_object();

            $detalhe = "<h3 align='center'> &nbsp;<b class='text-danger'>$noticia->titulo</b></h3>
                        <br>
                        <div class='p-20'>
                            <div align='center' class='col-12'>
                                <img src='../imagens/$noticia->nomeImagem' class='img-fluid'>
                            </div>
                            <br>
                            <p align='justify'>$noticia->descricao</p>
                        </div>";

            return  $detalhe;
        }
        
        public function listaNoticiaHome(){
            $con = $this->con();

            $sql = "SELECT * FROM Noticia LIMIT 3";
            
            $smt = $con->query($sql);
            
            $exibe = "";
            
            while(($noticia = $smt->fetch_object()) == true){
                $exibe .= "<div class='col-lg-4 col-md-7'>
                            <div class='card'>
                                <div class='el-card-item'>
                                    <div class='el-card-avatar el-overlay-1'> 
                                        <img src='../imagens/$noticia->nomeImagem' alt='$noticia->nomeImagem'>
                                        <div class='el-overlay'>
                                            <ul class='list-style-none el-info'>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline image-popup-vertical-fit el-link' href='../imagens/$noticia->nomeImagem'>
                                                        <i class='mdi mdi-magnify-plus'></i>
                                                    </a>
                                                </li>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline el-link' href='detalheNoticia.php?idNoticia=$noticia->idNoticia'>
                                                        Mais...
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='el-card-content'>
                                        <h4 class='m-b-0'>$noticia->titulo</h4>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
            
            return $exibe;
        }
        
        public function listaNoticia(){
            $con = $this->con();

            $sql = "SELECT * FROM Noticia";
            
            $smt = $con->query($sql);
            
            $exibe = "";
            
            while(($noticia = $smt->fetch_object()) == true){
                $exibe .= "<div class='col-lg-4 col-md-7'>
                            <div class='card'>
                                <div class='el-card-item'>
                                    <div class='el-card-avatar el-overlay-1'> 
                                        <img src='../imagens/$noticia->nomeImagem' alt='$noticia->nomeImagem'>
                                        <div class='el-overlay'>
                                            <ul class='list-style-none el-info'>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline image-popup-vertical-fit el-link' href='../imagens/$noticia->nomeImagem'>
                                                        <i class='mdi mdi-magnify-plus'></i>
                                                    </a>
                                                </li>
                                                <li class='el-item'>
                                                    <a class='btn default btn-outline el-link' href='detalheNoticia.php?idNoticia=$noticia->idNoticia'>
                                                        Mais...
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class='el-card-content'>
                                        <h4 class='m-b-0'>$noticia->titulo</h4>
                                    </div>
                                </div>
                            </div>
                        </div>";
            }
            
            return $exibe;
        }
        
        public function excluirNoticia($idNoticia){
            $this->idNoticia = $idNoticia;

            $con = $this->con();

            $sql = "DELETE FROM Noticia WHERE idNoticia=".$this->idNoticia;

            $smt = $con->query($sql);
        }
        
        public function alterarNoticia($idNoticia){
            $this->idNoticia = $idNoticia;
        
            $con = $this->con();

            $sql = "UPDATE Noticia SET titulo=?, descricao=?, nomeImagem=? WHERE idNoticia=".$this->idNoticia;

            $smt = $con->prepare($sql);        

            $smt->bind_param("sss",
                             $this->titulo,
                             $this->descricao,
                             $this->nomeImagem
                            );

            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function exibirNoticiaAltera(){
            $con = $this->con();
            
            $sql = "SELECT * FROM Noticia ORDER BY idNoticia DESC";
            
            $smt = $con->query($sql);
            
            $exibe = "<ul class='recent-posts'>";
            
            while(($noticia = $smt->fetch_object()) == true){
                $exibe .= "<li>
                                <div class='user-thumb'>
                                    <img width='100%' src='imagens/$noticia->nomeImagem'> 
                                </div>
                                <div class='article-post'>
                                    <div class='fr'>
                                        <a href='#' class='btn btn-primary btn-mini'>Edit</a>
                                        <a href='#' class='btn btn-danger btn-mini'>Delete</a>
                                    </div>
                                    <span class='user-info'>
                                        $noticia->titulo
                                    </span>
                                    <p>
                                        <a href='#'>$noticia->descricao</a>
                                    </p>
                                    <br>
                                </div>
                            </li>";
            }
            
            return $exibe .= "</ul>";
        }
        
        public function cadastrarNoticia(){
            $con = $this->con();
            
            $sql = "INSERT INTO Noticia VALUES(null, ?, ?, ?)";

            $smt = $con->prepare($sql);        

            $smt->bind_param("sss",
                             $this->titulo,
                             $this->descricao,
                             $this->nomeImagem
                            );

            $smt->execute();
            $smt->close();
            $con->close();
        }
        
        public function construtor($titulo, $descricao, $nomeImagem){
            $this->titulo = $titulo;
            $this->descricao = $descricao;
            $this->nomeImagem = $nomeImagem;
        }
        
        public function setTitulo($titulo){
            $this->titulo = $titulo;
        }
        public function getTitulo(){
            return $this->titulo;
        }
        
        
        public function setDescricao($descricao){
            $this->descricao = $descricao;
        }
        public function getDescricao(){
            return $this->descricao;
        }
        
        
        public function setNomeImagem($nomeImagem){
            $this->nomeImagem = $nomeImagem;
        }
        public function getNomeImagem(){
            return $this->nomeImagem;
        }
    }
?>