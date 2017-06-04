<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_log extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('log', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    

   

    function buscar($idregistro) {
        $sQl = "SELECT *FROM log WHERE idregistro=$idregistro";


        $query = $this->db->query($sQl);

        return $query;
    }

   

}