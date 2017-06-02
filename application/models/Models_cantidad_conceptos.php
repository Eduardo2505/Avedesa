<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_cantidad_conceptos extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('cantidad_conceptos', $data);

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
        $this->db->where('idcantidad_conceptos', $id);
        $this->db->update('cantidad_conceptos', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {


        return $query = $this->db->get('cantidad_conceptos');
    }

    function Buscarcapturado($idcosto_concepto, $idrecibo) {

        $this->db->where('idcosto_concepto', $idcosto_concepto);
        $this->db->where('idrecibo', $idrecibo);
        $query = $this->db->get('cantidad_conceptos');
        $idre = 0;
        if ($query->num_rows() == 0) {
            $idre = 0;
        } else {
            $row = $query->row();
            $idre = $row->idcantidad_conceptos;
        }

        return $idre;
    }

    function Buscarcapturadocantidad($idcosto_concepto, $idrecibo) {

        $this->db->where('idcosto_concepto', $idcosto_concepto);
        $this->db->where('idrecibo', $idrecibo);
        $query = $this->db->get('cantidad_conceptos');
        $idre = 0;
        if ($query->num_rows() == 0) {
            $idre = 0;
        } else {
            $row = $query->row();
            $idre = $row->cantidad;
        }

        return $idre;
    }

    function Buscar($id) {

        $this->db->where('idcantidad_conceptos', $id);
        $query = $this->db->get('cantidad_conceptos');
        return $query;
    }

    function sum($id) {


        $SQl = "SELECT 
    SUM(cantidad * costo) as sum
FROM
    cantidad_conceptos
WHERE
    idrecibo = $id";

        $query = $this->db->query($SQl);
        $row = $query->row();
        return $row->sum;
    }

}