<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_cat_puesto extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('cat_puesto', $data);

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
        $this->db->where('idcat_puesto', $id);
        $this->db->update('cat_puesto', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
             return 0;
        } else {
            $this->db->trans_commit();
             return 1;
        }
    }

    function get() {


        return $query = $this->db->get('cat_puesto');
    }
    
     function mostrarcount($nombre) {

        $SQl = "SELECT * FROM cat_puesto where puesto like '%$nombre%' ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $offset, $limin) {

        $SQl = "SELECT * FROM cat_puesto where puesto like '%$nombre%' ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idcat_puesto', $id);
        $query = $this->db->get('cat_puesto');
        return $query;
    }

}