<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_solicitante extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('solicitante', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function update($idregistro, $data) {

        $this->db->trans_begin();
        $this->db->where('idregistro', $idregistro);
        $this->db->update('solicitante', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    

    function buscarObj($idregistro) {

        $this->db->where('idregistro', $idregistro);
        $query = $this->db->get('solicitante');
        $row = $query->row();
        return $row;
    }

}