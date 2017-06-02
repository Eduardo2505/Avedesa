<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_estado_empleado extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('estado_empleado', $data);
        $id = $this->db->insert_id();

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return 0;
        } else {
            $this->db->trans_commit();
            return $id;
        }
    }
    function eliminar($id) {

        $this->db->trans_begin();
        $this->db->where('idestado_empleado', $id);
        $this->db->delete('estado_empleado');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function update($id, $data) {

        $this->db->trans_begin();
        $this->db->where('idestado_empleado', $id);
        $this->db->update('estado_empleado', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
             return 0;
        } else {
            $this->db->trans_commit();
            return 1;
        }
    }

    function mostrar() {

        $SQl = "SELECT 
        r.idregistro,
        r.num_expediente,
        er.estado,
        e.nombre,
        e.apellidos,
        ee.registro
        FROM
        registro r,
        estado_registro er,
        empleado e,
        estado_empleado ee
        where
        r.idregistro = ee.idregistro
        and er.idestado_registro = ee.idestado_registro
        and e.idempleado = ee.idempleado
        order by ee.registro desc
        limit 0 , 10";




        $query = $this->db->query($SQl);

        return $query;
    }

    function listarApp($nombre, $edo, $idempleado, $offset, $limin) {

        $SQl = "SELECT 
        r.num_expediente,
        r.idregistro,
        er.estado,
        r.fecha_de_inspeccion,
        r.hora_de_inspeccion,
        ee.idestado_empleado,
        er.idestado_registro
        FROM
        registro r,
        estado_registro er,
        empleado e,
        estado_empleado ee
        where
        r.idregistro = ee.idregistro
        and er.idestado_registro = ee.idestado_registro
        and e.idempleado = ee.idempleado
        and r.num_expediente like '%$nombre%' ";

        if(strcmp($edo,'') != 0){
            $SQl .=" and ee.estado =$edo";
        }

        if(strcmp($idempleado,'') != 0){
            $SQl .=" and ee.idempleado=$idempleado";
        }

    
        $SQl .=" order by ee.registro desc limit $offset, $limin";

   
        $query = $this->db->query($SQl);

        return $query;
    }

    function listar($nombre, $edo, $idempleado, $offset, $limin) {

        $SQl = "SELECT 
        r.idregistro,
        r.num_expediente,
        r.referencia,
        r.ubicacion,
        er.estado,
        e.nombre,
        e.apellidos,
        ee.registro,
        ee.estado as edo,
        r.estado_fecha,
        ee.idestado_empleado,
        er.idestado_registro
        FROM
        registro r,
        estado_registro er,
        empleado e,
        estado_empleado ee
        where
        r.idregistro = ee.idregistro
        and er.idestado_registro = ee.idestado_registro
        and e.idempleado = ee.idempleado
        and r.num_expediente like '%$nombre%' ";

        if(strcmp($edo,'') != 0){
            $SQl .=" and ee.estado =$edo";
        }

        if(strcmp($idempleado,'') != 0){
            $SQl .=" and ee.idempleado=$idempleado";
        }

    //echo $SQl;
        $SQl .=" order by ee.registro desc limit $offset, $limin";

   



        $query = $this->db->query($SQl);

        return $query;
    }

    function listarcount($nombre, $edo, $idempleado) {

        $SQl = "SELECT 
        r.idregistro,
        r.num_expediente,
        r.referencia,
        r.ubicacion,
        er.estado,
        e.nombre,
        e.apellidos,
        ee.registro,
        ee.estado as edo,
        r.estado_fecha,
        ee.idestado_empleado,
        er.idestado_registro
        FROM
        registro r,
        estado_registro er,
        empleado e,
        estado_empleado ee
        where
        r.idregistro = ee.idregistro
        and er.idestado_registro = ee.idestado_registro
        and e.idempleado = ee.idempleado
        and concat(r.idregistro, ' ', r.num_expediente) like '%$nombre%' ";

        if(strcmp($edo,'') != 0){
            $SQl .=" and ee.estado =$edo";
        }

        if(strcmp($idempleado,'') != 0){
            $SQl .=" and ee.idempleado=$idempleado";
        }

//echo $SQl;

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function Horafecha() {

        $SQl = "select now() as hora ";
        $query = $this->db->query($SQl);
        $row = $query->row();

        return $row->hora;
    }
    

 function comprobarActualizacion($idEstadoRegistro,$idregistro) {

        $SQl = "SELECT 
    *
        FROM
        estado_empleado
        where
        idestado_registro = $idEstadoRegistro
        and idregistro = $idregistro";

        $query = $this->db->query($SQl);


        return  $query->num_rows();
    }


    function comprobar($idEstadoRegistro,$idregistro,$estado) {

        $SQl = "SELECT 
    *
        FROM
        estado_empleado
        where
        idestado_registro = $idEstadoRegistro
        and idregistro = $idregistro and estado=$estado";

        $query = $this->db->query($SQl);


        return  $query->num_rows();
    }

    function mostrarRegistro($idregistro) {

        $SQl = "SELECT 
        r.idregistro,
        r.num_expediente,
        er.estado,
        e.nombre,
        e.apellidos,
        ee.registro,
        ee.idestado_empleado
        FROM
        registro r,
        estado_registro er,
        empleado e,
        estado_empleado ee
        where
        r.idregistro = ee.idregistro
        and er.idestado_registro = ee.idestado_registro
        and e.idempleado = ee.idempleado and r.idregistro=$idregistro
        order by ee.registro";




        $query = $this->db->query($SQl);

        return $query;
    }

    


}