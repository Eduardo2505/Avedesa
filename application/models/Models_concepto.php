<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_concepto extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('concepto', $data);

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
        $this->db->where('idconcepto', $id);
        $this->db->update('concepto', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    function eliminar($id) {

        $this->db->trans_begin();
        $this->db->where('idconcepto', $id);
        $this->db->delete('concepto');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {

        $this->db->order_by("nombre", "asc");
        return $query = $this->db->get('concepto');
    }

    function mostrarcount($nombre,$estado) {

        $SQl = "SELECT * FROM concepto where nombre like '%$nombre%' and estado like '%$estado%'";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre,$estado, $offset, $limin) {

        $SQl = "SELECT * FROM concepto where nombre like '%$nombre%' and estado like '%$estado%' order by nombre  ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idconcepto', $id);
        $query = $this->db->get('concepto');
        return $query;
    }

}