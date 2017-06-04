<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_estado_registro extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('estado_registro', $data);

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
        $this->db->where('idestado_registro', $id);
        $this->db->update('estado_registro', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function get() {

      $SQl = "SELECT * FROM estado_registro where idestado_registro!=6 and idestado_registro!=1";
      $query = $this->db->query($SQl);
      return $query;
  }

  function mostrarcount($nombre) {

    $SQl = "SELECT * FROM estado_registro where estado like '%$nombre%' ";

    $query = $this->db->query($SQl);

    return $query->num_rows();
}

function mostrar($nombre, $offset, $limin) {

    $SQl = "SELECT * FROM estado_registro where estado like '%$nombre%' ";


    $SQl .="  limit $offset, $limin";


    $query = $this->db->query($SQl);

    return $query;
}


function Buscar($id) {

    $this->db->where('idestado_registro', $id);
    $query = $this->db->get('estado_registro');
    return $query;
}




function consultarfechas($idregistro) {

    $SQl = "SELECT 
    ee.idestado_registro, ee.registro, CONCAT(e.Nombre, e.apellidos) as nombre
    FROM
    estado_empleado ee,
    estado_registro er,
    empleado e
    where
    ee.idestado_registro = er.idestado_registro
    and e.idempleado = ee.idempleado
    and ee.idregistro = $idregistro and ee.estado=1";

    $query = $this->db->query($SQl);

    //echo $SQl;

    return $query;
}



}