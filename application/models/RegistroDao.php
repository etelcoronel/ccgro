<?php
require_once APPPATH.'models/loadDatabase.php';
class RegistroDao extends LoadDatabase {
    
    function __construct(){
        parent::__construct();
    }

    function agregarRegistro($registro){
        return $this->db->insert("registro", $registro);
    }

}