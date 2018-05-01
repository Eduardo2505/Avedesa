<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_c_entidades_municipios extends CI_Model {

    function __construct() {

        parent::__construct();
        $this->load->database();

    }



    function getEstados() {


        $this->db->select('idEntidad, entidad');
        $this->db->distinct();
        return $query = $this->db->get('c_entidades_municipios');
    }


    function getMunicipios($idEstado) {

        $this->db->where('idEntidad', $idEstado);
        $this->db->select('idMunicipio, municipio');
        $this->db->distinct();
        return $query = $this->db->get('c_entidades_municipios');
    }

    function getNombreEstado($idEstado) {

        $this->db->where('idEntidad', $idEstado);
        $this->db->select('entidad');
        $this->db->distinct();
        $query = $this->db->get('c_entidades_municipios');
        $row = $query->row();
        return $row->entidad;
    }

     function getNombreMunicipio($idMunicipio) {
     
        $this->db->where('idMunicipio', $idMunicipio);
        $this->db->select('municipio');
        $this->db->distinct();
        $query = $this->db->get('c_entidades_municipios');
        $row = $query->row();
        return $row->municipio;
    }
    
    

    

}