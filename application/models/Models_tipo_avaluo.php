<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_tipo_avaluo extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('tipo_avaluo', $data);

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
        $this->db->where('idtipo_avaluo', $id);
        $this->db->update('tipo_avaluo', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function getWebservice() {

        $this->db->where('p_gys',1);
        return $query = $this->db->get('tipo_avaluo');
    }

    function get() {


        return $query = $this->db->get('tipo_avaluo');
    }

    function mostrarcount($nombre) {

        $SQl = "SELECT * FROM tipo_avaluo where nombre like '%$nombre%' ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $offset, $limin) {

        $SQl = "SELECT * FROM tipo_avaluo where nombre like '%$nombre%' ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idtipo_avaluo', $id);
        $query = $this->db->get('tipo_avaluo');
        return $query;
    }

}