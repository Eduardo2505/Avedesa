<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_avaluos extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('avaluos', $data);

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
        $this->db->where('idavaluos', $id);
        $this->db->update('avaluos', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }
    function eliminar($id) {

        $this->db->trans_begin();
        $this->db->where('idavaluos', $id);
        $this->db->delete('avaluos');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get() {


        return $query = $this->db->get('avaluos');
    }

    function mostrarcount($nombre,$empleado) {

        $SQl = "SELECT * FROM avaluos a , empleado e,quincena q where q.idquincena=a.idquincena and  a.idempleado=e.idempleado and a.numero like '%$nombre%' and  concat(e.Nombre,' ',e.apellidos) like '%$empleado%'";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre,$empleado, $offset, $limin) {

        $SQl = "SELECT * FROM avaluos a , empleado e,quincena q where q.idquincena=a.idquincena and a.idempleado=e.idempleado and a.numero like '%$nombre%' and  concat(e.Nombre,' ',e.apellidos) like '%$empleado%'";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }
    
    //unificadas
    function mostrarcountem($nombre,$idempleado) {

        $SQl = "SELECT * FROM avaluos a , empleado e,quincena q where q.idquincena=a.idquincena and a.idempleado=e.idempleado and a.numero like '%$nombre%' and a.idempleado='$idempleado' ";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrarem($nombre,$idempleado, $offset, $limin) {

        $SQl = "SELECT * FROM avaluos a , empleado e, quincena q where q.idquincena=a.idquincena and a.idempleado=e.idempleado and a.numero like '%$nombre%' and a.idempleado='$idempleado' ";


        $SQl .="  limit $offset, $limin";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {

        $this->db->where('idavaluos', $id);
        $query = $this->db->get('avaluos');
        return $query;
    }

    function BuscarExistencia($numero, $idtipo) {
        $SQl = "SELECT * FROM avaluos a , empleado e where  a.idempleado=e.idempleado and a.numero='$numero' and a.idtipo='$idtipo'";
        $query = $this->db->query($SQl);
        $ve = $query->num_rows();
        $veri="";
        if($ve!=0){
            $veri= $query->row();
        }else{
            $veri="-";
        }

        return $veri;
        
       
    }

}