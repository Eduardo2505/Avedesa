<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_intermediariofinanciero extends CI_Model {

    function __construct() {

        parent::__construct();
        $this->load->database();

    }

   

    function get() {
    	
        return $query = $this->db->get('intermediariofinanciero');
    }

     function buscardescripcion($clave) {
    	$this->db->where('clave', $clave);
        $query = $this->db->get('intermediariofinanciero');
        $row = $query->row();
        return $row->descripcion;
    }


  

    

}