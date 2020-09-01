<?php

    class Conexion
    {
        private $serverName="localhost";
        private $usuario="root";
        private $pwsd="";
        private $dbName="bdminimercado";
        private $link;
    
        function Open()
        {
            $this->link=mysqli_connect($this->serverName,$this->usuario,$this->pwsd);
            mysqli_set_charset($this->link, 'utf8');
            mysqli_select_db($this->link,$this->dbName);
        }
        function Execute($_sql)
        {
            date_default_timezone_set('America/La_Paz');
            $res=mysqli_query($this->link, $_sql);
            return $res;
        }
        function getCon()
        {
            return $this->link;
        }
    }
    
?>