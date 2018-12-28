<?php
    class Conexao{
        public function conectar(){
            $con = new mysqli("localhost", "root", "", "bd_fpj"); 
            
            return $con;
        }
    }
?>