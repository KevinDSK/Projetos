<?php
    class Evento{
        public function con(){
            include_once("Conexao.php");
            $conexao = new Conexao();

            $con = $conexao->conectar();

            return $con;
        }
        
        public function exibirEvento($iddelegacia){
            $this->iddelegacia = $iddelegacia;
                
            $con = $this->con();

            $sql = "SELECT * FROM Campeonato INNER JOIN Cidade ON Campeonato.idcidade = Cidade.idCidade WHERE iddelegacia=".$this->iddelegacia;

            $smt = $con->query($sql);

            $tabela = "$(document).ready(function() {
                        $('#evento').fullCalendar({
                            header: {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'month'
                            },
                            
                            defaultDate: Date(),
                            navLinks: true,
                            editable: true,
                            eventLimit: true,
                            eventClick: function(event) {
                                $('#detalhe #idCampeonato').text(event.id);
                                $('#detalhe #idCampeonato').val(event.id);
                                $('#detalhe #nomeCampeonato').text(event.title);
                                $('#detalhe #data').text(event.start.format('DD/MM/YYYY'));
                                $('#detalhe #tipoCampeonato').text(event.type);
                                $('#detalhe #local').text(event.local);
                                $('#detalhe').modal('show');
                                return false;
                            },
                            events: [";

            while(($evento = $smt->fetch_object()) == true){
                if(($evento->tipoCampeonato) == "Oficial"){
                    $tabela .= "    {
                                            id: '$evento->idCampeonato',
                                            title: '$evento->nomeCampeonato',
                                            start: '$evento->data',
                                            type: '$evento->tipoCampeonato',
                                            local: '$evento->nome',
                                            color: 'orange',
                                    },";
                    
                }
                
                if(($evento->tipoCampeonato) == "Amistoso"){
                    $tabela .= "    {
                                            id: '$evento->idCampeonato',
                                            title: '$evento->nomeCampeonato',
                                            start: '$evento->data',
                                            type: '$evento->tipoCampeonato',
                                            local: '$evento->nome',
                                            color: 'red',
                                    },";
                    
                }
                
                if(($evento->tipoCampeonato) == "Festival"){
                    $tabela .= "    {
                                            id: '$evento->idCampeonato',
                                            title: '$evento->nomeCampeonato',
                                            start: '$evento->data',
                                            type: '$evento->tipoCampeonato',
                                            local: '$evento->nome',
                                            color: 'blue',
                                    },";
                    
                }else if(($evento->tipoCampeonato) == "Reuniao"){
                    $tabela .= "    {
                                            id: '$evento->idCampeonato',
                                            title: '$evento->nomeCampeonato',
                                            start: '$evento->data',
                                            type: '$evento->tipoCampeonato',
                                            local: '$evento->nome',
                                            color: 'green',
                                    },";
                    
                }
                
                if(($evento->tipoCampeonato) == "Curso"){
                    $tabela .= "    {
                                            id: '$evento->idCampeonato',
                                            title: '$evento->nomeCampeonato',
                                            start: '$evento->data',
                                            type: '$evento->tipoCampeonato',
                                            local: '$evento->nome',
                                            color: 'brown',
                                    },";
                    
                }
            }
            
            return  $tabela .= "   ]
                        });
                    });";
        }
    }
?>