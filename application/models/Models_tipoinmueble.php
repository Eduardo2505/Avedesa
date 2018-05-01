<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_tipoinmueble extends CI_Model {

    function __construct() {

        parent::__construct();
        $this->load->database();

    }

   

    function get() {
    	
        return $query = $this->db->get('tipoinmueble');
    }


  

    

}