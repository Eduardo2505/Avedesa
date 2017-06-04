<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_objetivo_avaluo extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('objetivo_avaluo', $data);

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
        $this->db->where('idobjetivo_avaluo', $id);
        $this->db->update('objetivo_avaluo', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {


        return $query = $this->db->get('objetivo_avaluo');
    }
    
    
     function mostrarcount($nombre) {

        $SQl = "SELECT * FROM objetivo_avaluo where nombre like '%$nombre%' and idobjetivo_avaluo!=0 ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $offset, $limin) {

        $SQl = "SELECT * FROM objetivo_avaluo where nombre like '%$nombre%' and idobjetivo_avaluo!=0 ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idobjetivo_avaluo', $id);
        $query = $this->db->get('objetivo_avaluo');
        return $query;
    }

}