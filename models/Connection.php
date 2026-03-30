<?php

    class Connection{

        protected $conn;
        private $config="conf.json";

        public function __construct(){
            $this->makeconnection();
        }

        public function makeconnection(){
            $configJson=file_get_contents($this->config);
            $c = json_decode($configJson, true);
            $dsn="mysql:host=" . $c["host"] . ";dbname=". $c ["db"];
            $this-> conn = new PDO ($dsn , $c["userName"], $c["password"]);
        }

        public function getConnection(){
            return $this->conn;
        }

        public function __destruct(){
            $this->conn=null;
        }
    }
