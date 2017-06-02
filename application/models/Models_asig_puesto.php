<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_asig_puesto extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

      
        $this->db->insert('asig_puesto', $data);

        
    }

    function update($id, $data) {

     
        $this->db->where('idasig_puesto', $id);
        $this->db->update('asig_puesto', $data);

        
    }

    function get() {


        return $query = $this->db->get('asig_puesto');
    }
    
    

    function mostrar($nombre, $offset, $limin) {

        $SQl = "SELECT * FROM cat_puesto where puesto like '%$nombre%' ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idasig_puesto', $id);
        $query = $this->db->get('asig_puesto');
        return $query;
    }
    
     function eliminar($idEmpleado) {

        $SQl = " DELETE FROM asig_puesto 
WHERE
    idempleado = (SELECT 
        idempleado
    FROM
        empleado
    
    WHERE
        idempleado = $idEmpleado)";
        $this->db->query($SQl);

        return 1;
    }

}