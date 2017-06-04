<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_empresa extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('empresa', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
              return 0;
        } else {
            $this->db->trans_commit();
              return 1;
        }
    }

    function update($id, $data) {

        $this->db->trans_begin();
        $this->db->where('idempresa', $id);
        $this->db->update('empresa', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {


        return $query = $this->db->get('empresa');
    }
    
    
     function mostrarcount($nombre) {

        $SQl = "SELECT * FROM empresa where nombre like '%$nombre%' ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $offset, $limin) {

        $SQl = "SELECT * FROM empresa where nombre like '%$nombre%' ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idempresa', $id);
        $query = $this->db->get('empresa');
        return $query;
    }

}