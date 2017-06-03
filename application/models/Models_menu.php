<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_menu extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    

    function get($idEmpleado) {

      $this->db->select('m.url,m.img');
      $this->db->distinct('m.url');
      $this->db->from('empleado e');
      $this->db->join('asig_puesto a', 'e.idempleado = a.idempleado');
      $this->db->join('cat_puesto p', 'p.idcat_puesto = a.idcat_puesto');
      $this->db->join('menu m', 'p.idcat_puesto = m.idcat_puesto');
      $this->db->where('e.idempleado', $idEmpleado);
      $query = $this->db->get();
      return $query;
  }

}