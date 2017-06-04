<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_costo_concepto extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('costo_concepto', $data);

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
        $this->db->where('idcosto_concepto', $id);
        $this->db->update('costo_concepto', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }
    function eliminar($id) {

        $this->db->trans_begin();
        $this->db->where('idcosto_concepto', $id);
        $this->db->delete('costo_concepto');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {


        return $query = $this->db->get('empresa');
    }
    
    
     function mostrarcount($concepto, $empleado) {

        $SQl = "SELECT 
    c.nombre as concepto,
    CONCAT(e.Nombre, ' ', e.apellidos) as empleado,
    cc.costo as costo,cc.idcosto_concepto
FROM
    costo_concepto cc,
    concepto c,
    empleado e
where
    cc.idconcepto = c.idconcepto
        and cc.idempleado = e.idempleado
        and CONCAT(e.Nombre, ' ', e.apellidos) like '%$empleado%'
        and c.nombre like '%$concepto%'";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($concepto, $empleado, $offset, $limin) {

        $SQl = "SELECT 
    c.nombre as concepto,
    CONCAT(e.Nombre, ' ', e.apellidos) as empleado,
    cc.costo as costo,cc.idcosto_concepto
FROM
    costo_concepto cc,
    concepto c,
    empleado e
where
    cc.idconcepto = c.idconcepto
        and cc.idempleado = e.idempleado
        and CONCAT(e.Nombre, ' ', e.apellidos) like '%$empleado%'
        and c.nombre like '%$concepto%' order by CONCAT(e.Nombre, ' ', e.apellidos),c.nombre";


        $SQl .="  limit $offset, $limin";

        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idcosto_concepto', $id);
        $query = $this->db->get('costo_concepto');
        return $query;
    }

}