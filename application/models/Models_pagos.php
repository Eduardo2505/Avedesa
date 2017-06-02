<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_pagos extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('pagos', $data);

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
        $this->db->where('idpagos', $id);
        $this->db->update('pagos', $data);


        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
             return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function eliminar($id) {

     $this->db->trans_begin();
     $this->db->where('idpagos', $id);
     $this->db->delete('pagos');

     if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
    } else {
        $this->db->trans_commit();
    }
}



function getPagosUsuario($idempleado,$idregistro) {

    $this->db->where('idempleado', $idempleado);
    $this->db->where('idregistro', $idregistro);
    $this->db->where('estado', 1);
    $this->db->order_by('registro', 'DESC');
    $query = $this->db->get('pagos');
    return $query;
}

function Buscar($idregistro) {

    $this->db->where('idregistro', $idregistro);
    $this->db->where('estado', 1);
    $query = $this->db->get('pagos');
    return $query;
}

function mostrarEliminados($idregistro) {

    $SQl = "SELECT 
    pa.anticipo,
    pa.descripcion,
    pa.registro,
    pa.usuario,
    p.usuario AS usuarioElimanado,
    p.registro AS registroEliminado
    FROM
    pagoseliminados p,
    pagos pa
    WHERE
    p.idpagos=pa.idpagos and
    pa.estado = 0 AND pa.idregistro = $idregistro";

    $query = $this->db->query($SQl);

    return $query;
}

}