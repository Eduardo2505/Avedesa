<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_ave_avaluos_usuario extends CI_Model {

    function __construct() {
        parent::__construct();

        $this->db_b = $this->load->database('antecedentes', true);   
    }


    function login($idusuario,$clave) {

       $this->db_b->where('idusuario', $idusuario);
       $this->db_b->where('clave', $clave);
       $this->db_b->where('estado', 1);
       $query = $this->db_b->get('usuario');
       return $query;
   }




}