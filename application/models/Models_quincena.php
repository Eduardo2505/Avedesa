<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_quincena extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {
        $id = 0;
        $this->db->trans_begin();
        $this->db->insert('quincena', $data);
        $id = $this->db->insert_id();
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return -1;
        } else {
            $this->db->trans_commit();

            return $id;
        }
    }

    function update($id, $data) {

        $this->db->trans_begin();
        $this->db->where('idquincena', $id);
        $this->db->update('quincena', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {


        return $query = $this->db->get('quincena');
    }

    function getactivos() {

        $this->db->where('estado', 'Activo');
        return $query = $this->db->get('quincena');
    }

    function mostrarcount($inicio, $final) {

        if ($inicio == "") {

            $SQl = "SELECT 
    *
FROM
    quincena order by idquincena desc";
        } else {
            $SQl = "SELECT 
    *
FROM
    quincena
where
    inicio BETWEEN '$inicio' and '$final'
        and final BETWEEN '$inicio' and '$final'
order by idquincena desc";
        }

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($inicio, $final, $offset, $limin) {

        if ($inicio == "") {

            $SQl = "SELECT 
    *
FROM
    quincena order by idquincena desc";
        } else {
            $SQl = "SELECT 
    *
FROM
    quincena
where
    inicio BETWEEN '$inicio' and '$final'
        and final BETWEEN '$inicio' and '$final'
order by idquincena desc";
        }





        $SQl .="  limit $offset, $limin ";

        //echo $SQl;
        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idquincena', $id);
        $query = $this->db->get('quincena');
        return $query;
    }

     function getBuscarActivos() {

       
        $this->db->where('estado', 'Activo');
        $query = $this->db->get('quincena');
        return $query->num_rows();
    }

}