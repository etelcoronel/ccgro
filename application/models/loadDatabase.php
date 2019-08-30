<?php

class LoadDatabase extends CI_Model
{
    public function __construct()
    {     
        $this->load->database();
    }

    //*Funcion que solo te regresa una fila de la cosulta
    function getRow($sql){
        $query = $this->db->query($sql);
        $row= $query->row();
        return empty($row)?FALSE : $row;
    }
    
    //*Funcion que solo te regresa las primeras 20 filas de la cosulta
    function getPage($sql,$start=0,$limit=20){
        $start= empty($start)?0:$start;
        $limit= empty($limit)?20:$limit;
        $query = $this->db->query($sql." limit {$start},{$limit}");
        $resultado= $query->result();
        $query= $this->db->query($sql);
        $filas= $query->num_rows();
        return json_encode( array("data"=>$resultado,"numFilas"=>$filas));
    }

    //*Funcion que  te regresa todas las filas de la cosulta
    function getPageAll($sql){
        $query = $this->db->query($sql);
        $resultado= $query->result();
        $filas= $query->num_rows();
        return json_encode(array("data"=>$resultado,"numFilas"=>$filas)) ;
    }

}