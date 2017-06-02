<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_intermediario extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('intermediario', $data);

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
        $this->db->where('idintermediario', $id);
        $this->db->update('intermediario', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
             return 1;
        }
    }

    function get() {


        return $query = $this->db->get('intermediario');
    }
    
    function mostrarcount($nombre) {

        $SQl = "SELECT * FROM intermediario where nombre like '%$nombre%' ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $offset, $limin) {

        $SQl = "SELECT * FROM intermediario where nombre like '%$nombre%' ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idintermediario', $id);
        $query = $this->db->get('intermediario');
        return $query;
    }

}