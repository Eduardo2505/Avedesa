<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Models_recibo extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function insertar($data) {

        $this->db->trans_begin();
        $this->db->insert('recibo', $data);

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
        $this->db->where('idrecibo', $id);
        $this->db->update('recibo', $data);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function eliminar($id) {

        $this->db->trans_begin();
        $this->db->where('idrecibo', $id);
        $this->db->delete('recibo');

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    function get($idQuincena, $estado) {

        $this->db->where('idquincena', $idQuincena);
        $this->db->where('estado', $estado);
        return $query = $this->db->get('recibo');
    }

    function mostrarcount($nombre, $idquincena) {

        $SQl = "SELECT 
        q.inicio,
        q.final,
        q.pagada,
        e.Nombre,
        e.apellidos,
        r.idrecibo
        FROM
        empleado e,
        quincena q,
        recibo r
        WHERE
        e.idempleado = r.idempleado
        AND r.idquincena = q.idquincena
        AND r.idquincena = $idquincena
        AND CONCAT(e.Nombre, ' ', e.apellidos) LIKE '%$nombre%'";

        $query = $this->db->query($SQl);

        return $query->num_rows();
    }

    function mostrar($nombre, $idquincena, $offset, $limin) {

        $SQl = "SELECT 
        q.inicio,
        q.final,
        q.pagada,
        e.Nombre,
        e.apellidos,
        r.idrecibo,
        r.estado reestado
        FROM
        empleado e,
        quincena q,
        recibo r
        WHERE
        e.idempleado = r.idempleado
        AND r.idquincena = q.idquincena
        AND r.idquincena = $idquincena
        AND CONCAT(e.Nombre, ' ', e.apellidos) LIKE '%$nombre%' order by CONCAT(e.Nombre, ' ', e.apellidos)";


        $SQl .="  limit $offset, $limin ";


        $query = $this->db->query($SQl);

        return $query;
    }

    function Buscar($id) {
        $SQl = "SELECT 
        r.*,r.estado reestado, CONCAT(e.Nombre, ' ', e.apellidos) AS nomempleado, q.*
        FROM
        empleado e,
        quincena q,
        recibo r
        WHERE
        r.idempleado = e.idempleado
        AND r.idquincena = q.idquincena
        AND r.idrecibo = $id";
        
     //   echo $SQl;
        $query = $this->db->query($SQl);


        return $query;
    }



    function calcularPago($idrecibo) {
        $SQl = "SELECT 
        (nomina + extra + pasajes) - (transferencia + deducciones + retardos + abono + anticipo) AS pagar
        FROM
        recibo
        WHERE
        idrecibo = $idrecibo";

     //   echo $SQl;
        $query = $this->db->query($SQl);
        $row = $query->row();
        $idre = $row->pagar;
        return $idre;
    }


    function Buscarquin($idquincena, $idempleado) {

        $this->db->where('idquincena', $idquincena);
        $this->db->where('idempleado', $idempleado);
        $query = $this->db->get('recibo');
        $idre = 0;
        if ($query->num_rows() == 0) {
            $idre = 0;
        } else {
            $row = $query->row();
            $idre = $row->idrecibo;
        }

        return $idre;
    }

    function conceptos($idempleado,$estado) {

        $SQl = "SELECT 
        c.nombre, cc.costo, cc.idcosto_concepto
        FROM
        concepto c,
        costo_concepto cc
        WHERE
        c.idconcepto = cc.idconcepto
        AND cc.idempleado = $idempleado and c.estado=$estado";


        $query = $this->db->query($SQl);

        return $query;
    }

    function conceptosotros($idquince,$idempleado) {

        $SQl = "SELECT 
        tipo, count(tipo) as cantidad,costo, observacion
        FROM
        avaluos
        WHERE
        idtipo IN (2,3) and idquincena = $idquince and idempleado=$idempleado
        group by costo,observacion,tipo";


        $query = $this->db->query($SQl);

        return $query;
    }

}