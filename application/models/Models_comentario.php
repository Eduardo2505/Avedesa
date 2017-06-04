<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_comentario extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('comentario', $data);

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
        $this->db->where('idcomentario', $id);
        $this->db->update('comentario', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function eliminar($id) {

        $this->db->trans_begin();
        $this->db->where('idcomentario', $id);
        $this->db->delete('comentario');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

  

    function mostrarcount($nombre, $idregistro) {

        $SQl = "SELECT * FROM comentario where comentario like '%$nombre%' and idregistro=$idregistro ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $idregistro, $offset, $limin) {


        $SQl = "SELECT * FROM comentario where comentario like '%$nombre%' and idregistro=$idregistro  order by registro desc  ";


        $SQl .="  limit $offset, $limin";
//echo $SQl;

        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idcomentario', $id);
        $query = $this->db->get('comentario');
        return $query;
    }

 

}